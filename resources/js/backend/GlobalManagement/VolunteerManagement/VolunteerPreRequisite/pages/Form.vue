
<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">
                        {{ param_id ? `${setup.edit_page_title}` : `${setup.create_page_title}` }}
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
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Title</label>
                            <input 
                                type="text" 
                                name="title"
                                class="form-control" 
                                v-model="formData.title" 
                                placeholder="Enter your title"
                            />
                        </div>
                        
                        <div class="col-12 mt-3">
                            <label class="form-label font-weight-bold">Options</label>
                            <input type="hidden" name="option" ref="optionInput">
                            <div v-for="(option, idx) in options" :key="idx" class="input-group mb-2">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="options[idx]"
                                    :placeholder="`Option ${idx+1}`"
                                />
                                <div class="input-group-append">
                                    <button v-if="options.length > 1" type="button" class="btn btn-danger" @click="removeOption(idx)">
                                        -
                                    </button>
                                    <button v-if="idx === options.length-1" type="button" class="btn btn-success" @click="addOption">
                                        +
                                    </button>
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

        export default {
        components: {        },

    data: () => ({
        setup,
        param_id: null,
        formData: {
            title: "",
            option: ""
        },
        options: ["", "", "", ""],
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
            this.formData = {
                title: "",
                option: ""
            };
            this.options = ["", "", "", ""];
        },
        set_fields: async function (id) {
            this.param_id = id;
            await this.details(id);
            if (this.item) {
                this.formData.title = this.item.title || "";
                if (this.item.option) {
                    try {
                        this.options = JSON.parse(this.item.option) || ["", "", "", ""];
                    } catch (e) {
                        this.options = ["", "", "", ""];
                    }
                } else {
                    this.options = ["", "", "", ""];
                }
            }
        },
        submitHandler: async function ($event) {
            this.set_only_latest_data(true);
            // Prepare option as JSON
            this.formData.option = JSON.stringify(this.options.filter(o => o.trim() !== ""));
            // Set the hidden input value
            this.$refs.optionInput.value = this.formData.option;

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
                    window.s_alert("Data Successfully Created");
                }
            }
        },
        addOption() {
            this.options.push("");
        },
        removeOption(idx) {
            if (this.options.length > 1) {
                this.options.splice(idx, 1);
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


