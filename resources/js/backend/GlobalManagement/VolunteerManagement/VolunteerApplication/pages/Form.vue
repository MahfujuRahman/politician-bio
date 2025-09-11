
<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">
                        {{ param_id ? `${setup.edit_page_title}` : `${setup . create_page_title}` }}

                    </h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm" :to="{
                            name: `Details${setup.route_prefix}`,
                            params: { id: item.slug },
                        }">
                            {{ setup.details_page_title }}
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            {{ setup.all_page_title }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                
                        <template v-for="(form_field, index) in form_fields" v-bind:key="index">

                            <common-input :label="form_field.label" :type="form_field.type" :name="form_field.name"
                                :multiple="form_field.multiple" :value="form_field.value"
                                :data_list="form_field.data_list" :is_visible="form_field.is_visible"
                                :row_col_class="form_field.row_col_class" />

                        </template>

                        <!-- Prerequisite Section -->
                        <div class="col-12 mt-4">
                            <h6 class="font-weight-bold">Prerequisites</h6>
                            <div v-for="(options, prereq_id) in selected_prerequisites" :key="prereq_id">
                                <input type="hidden" :name="`selected_prerequisites[${prereq_id}][]`" v-for="option_id in options" :key="option_id" :value="option_id">
                            </div>
                            <div v-for="prereq in prerequisites" :key="prereq.id" class="border p-3 mb-3">
                                <h6>{{ prereq.title }}</h6>
                                <div class="check-box-wrapper">
                                    <div v-for="option in prereq.options" :key="option.id" class="check-box">
                                        <label class="container-box"> 
                                            <input
                                                type="checkbox"
                                                :checked="selected_prerequisites[prereq.id]?.includes(option.id)"
                                                @change="toggle_prerequisite_option(prereq.id, option.id)"
                                            />
                                            <span class="checkmark"></span>
                                            <span class="ml-2"> {{ option.title }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-light btn-square px-5">
                        <i class="icon-lock"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { store } from "../store";
import setup from "../setup";
import form_fields from "../setup/form_fields";

        export default {
        components: {        },

    data: () => ({
        setup,
        form_fields,
        param_id: null,
        prerequisites: [],
        selected_prerequisites: {},
    }),
    created: async function () {
        let id = (this.param_id = this.$route.params.id);
        this.reset_fields();
        if (id) {
            this.set_fields(id);
        }
    },
    methods: {
        ...mapActions(store, {
            create: "create",
            update: "update",
            details: "details",
            get_all: "get_all",
            set_only_latest_data: "set_only_latest_data",
        }),
        reset_fields: function () {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
            this.selected_prerequisites = {};
        },
        set_fields: async function (id) {
            this.param_id = id;
            await this.details(id);
            if (this.item) {
                this.form_fields.forEach((field, index) => {
                    Object.entries(this.item).forEach((value) => {
                        if (field.name == value[0]) {
                            this.form_fields[index].value = value[1];
                        }
                        // If the field is a textarea, set its summernote content dynamically
                        if (field.type === "textarea" && field.name === value[0]) {
                            $(`#${field . name}`).summernote("code", value[1]);
                        }
                    });
                });
                // Load prerequisites from item
                this.prerequisites = this.item.prerequisites ? [...new Map(this.item.prerequisites.map(p => [p.prerequisite.id, p.prerequisite])).values()] : [];
                // Load selected prerequisites
                this.selected_prerequisites = {};
                if (this.item.prerequisites) {
                    this.item.prerequisites.forEach(p => {
                        if (!this.selected_prerequisites[p.prerequisite_id]) {
                            this.selected_prerequisites[p.prerequisite_id] = [];
                        }
                        this.selected_prerequisites[p.prerequisite_id].push(parseInt(p.prerequisite_option_id));
                    });
                }
            }
        },
        submitHandler: async function ($event) {
            this.set_only_latest_data(true);
            this.setSummerEditor();

            let response;
            if (this.param_id) {
                response = await this.update($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("Data successfully updated");
                    this.$router.push({ name: `Details${this.setup.route_prefix}` });
                }
            } else {
                response = await this.create($event);
                if ([200, 201].includes(response.status)) {
                    $event.target.reset();
                    this.reset_fields();
                    // Clear summernote editors for all textarea fields
                    this.form_fields.forEach(field => {
                        if (field.type === 'textarea' && $(`#${field.name}`).length) {
                            $(`#${field.name}`).summernote("code", '');
                        }
                    });
                    window.s_alert("Data Successfully Created");
                }
            }
        },
        setSummerEditor() {
            // Dynamically set summernote content for all textarea fields
            this.form_fields.forEach(field => {
                if (field.type === 'textarea' && $(`#${field . name}`).length) {
                    const markupStr = $(`#${field . name}`).summernote("code");
                    // Set the value in the form field object
                    field.value = markupStr;
                    // Optionally, update a hidden input if your backend expects it
                    let $input = $(`#${field . name}_hidden`);
                    if ($input.length === 0) {
                        $input = $(`<input type="hidden" id="${field . name}_hidden" name="${field . name}">`);
                        $(`#${field . name}`).parent().append($input);
                    }
                    $input.val(markupStr);
                }
            });
        },
        async fetch_prerequisites() {
            try {
                const response = await axios.get('/volunteer-pre-requisites', {
                    params: { get_all: 1, limit: 1000 }
                });
                this.prerequisites = response.data.data || [];
            } catch (error) {
                console.error('Error fetching prerequisites:', error);
            }
        },
        toggle_prerequisite_option(prereq_id, option_id) {
            if (!this.selected_prerequisites[prereq_id]) {
                this.selected_prerequisites[prereq_id] = [];
            }
            const index = this.selected_prerequisites[prereq_id].indexOf(option_id);
            if (index > -1) {
                this.selected_prerequisites[prereq_id].splice(index, 1);
            } else {
                this.selected_prerequisites[prereq_id].push(option_id);
            }
        },
    },

    computed: {
        ...mapState(store, {
            item: "item",
        }),
    },
};
</script>


