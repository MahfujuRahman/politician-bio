
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
                            <h6 class="font-weight-bold">Prerequisite</h6>
                            <input type="hidden" name="prerequisite" ref="prerequisiteInput">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Title</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        v-model="prerequisite.title" 
                                        placeholder="Enter prerequisite title"
                                    />
                                </div>
                                <div class="col-12">
                                    <label class="form-label font-weight-bold">Options</label>
                                    <div v-for="(option, idx) in prerequisite.options" :key="idx" class="input-group mb-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="prerequisite.options[idx]"
                                            :placeholder="`Option ${idx+1}`"
                                        />
                                        <div class="input-group-append">
                                            <button v-if="prerequisite.options.length > 1" type="button" class="btn btn-danger" @click="removePrerequisiteOption(idx)">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button v-if="idx === prerequisite.options.length-1" type="button" class="btn btn-success" @click="addPrerequisiteOption">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
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
        prerequisite: {
            title: '',
            options: ['', '', '', '']
        },
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
            this.prerequisite = {
                title: '',
                options: ['', '', '', '']
            };
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
                // Load prerequisite
                if (this.item.prerequisite) {
                    try {
                        this.prerequisite = JSON.parse(this.item.prerequisite) || { title: '', options: ['', '', '', ''] };
                    } catch (e) {
                        this.prerequisite = { title: '', options: ['', '', '', ''] };
                    }
                } else {
                    this.prerequisite = { title: '', options: ['', '', '', ''] };
                }
            }
        },
        submitHandler: async function ($event) {
            this.set_only_latest_data(true);
            this.setSummerEditor();
            // Set prerequisite as JSON
            this.$refs.prerequisiteInput.value = JSON.stringify({
                title: this.prerequisite.title,
                options: this.prerequisite.options.filter(o => o.trim() !== '')
            });

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
        addPrerequisiteOption() {
            this.prerequisite.options.push('');
        },
        removePrerequisiteOption(idx) {
            if (this.prerequisite.options.length > 1) {
                this.prerequisite.options.splice(idx, 1);
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


