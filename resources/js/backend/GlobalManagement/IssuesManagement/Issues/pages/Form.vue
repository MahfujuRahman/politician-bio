<template>
  <div>
    <form @submit.prevent="submitHandler">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5 class="text-capitalize">
            {{
              param_id
                ? `${setup.edit_page_title}`
                : `${setup.create_page_title}`
            }}
          </h5>
          <div>
            <router-link
              v-if="item.slug"
              class="btn btn-outline-info mr-2 btn-sm"
              :to="{
                name: `Details${setup.route_prefix}`,
                params: { id: item.slug },
              }"
            >
              {{ setup.details_page_title }}
            </router-link>
            <router-link
              class="btn btn-outline-warning btn-sm"
              :to="{ name: `All${setup.route_prefix}` }"
            >
              {{ setup.all_page_title }}
            </router-link>
          </div>
        </div>
        <div class="card-body card_body_fixed_height">
          <div class="row">
            <template
              v-for="(form_field, index) in form_fields"
              v-bind:key="index"
            >
              <common-input
                :label="form_field.label"
                :type="form_field.type"
                :name="form_field.name"
                :multiple="form_field.multiple"
                :value="form_field.value"
                :data_list="form_field.data_list"
                :is_visible="form_field.is_visible"
                :row_col_class="form_field.row_col_class"
              />
            </template>
            <multi-chip :name="`tag`" />

            <!-- for facts_and_features list input start-->
            <div class="col-md-12 pt-3">
              <div
                class="d-flex justify-content-between align-items-center pb-2 section-title"
              >
                <h5 class="m-0">Add taking action</h5>
                <button
                  class="btn btn-sm btn-outline-success"
                  @click.prevent="add_row('taking_action')"
                >
                  Add row
                </button>
              </div>
              <div
                class="row align-items-center justify-content-start"
                v-for="(taking_action, index) in taking_action_data"
                :key="index"
              >
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">title</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`taking_action[${index}][title]`"
                        v-model="taking_action.title"
                        id="title"
                        :class="{
                          custom_error:
                            errors['taking_action'] &&
                            errors['taking_action'][index] &&
                            errors['taking_action'][index].title,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['taking_action'] &&
                        errors['taking_action'][index] &&
                        errors['taking_action'][index].title
                      "
                      class="text-danger small"
                    >
                      {{ errors["taking_action"][index].title }}
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">description</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`taking_action[${index}][description]`"
                        v-model="taking_action.description"
                        id="description"
                        :class="{
                          custom_error:
                            errors['taking_action'] &&
                            errors['taking_action'][index] &&
                            errors['taking_action'][index].description,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['taking_action'] &&
                        errors['taking_action'][index] &&
                        errors['taking_action'][index].description
                      "
                      class="text-danger small"
                    >
                      {{ errors["taking_action"][index].description }}
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-1 d-flex align-items-center justify-content-center"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    :style="{
                      width: '50%',
                      marginTop:
                        !errors['taking_action']?.[index]?.title &&
                        !errors['taking_action']?.[index]?.description
                          ? '30px'
                          : '0',
                    }"
                    @click.prevent="delete_row('taking_action', index)"
                  >
                    <i class="fa fa-trash"></i>
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
import form_fields from "../setup/form_fields";
import MultiChip from "../components/meta_component/MultiChip.vue";

export default {
  components: {
    MultiChip,
  },

  data: () => ({
    setup,
    form_fields,
    param_id: null,
    errors: {},

    //----------- for taking_action list input ----------

    taking_action_data_object: {
      title: "",
      description: "",
    },
    taking_action_data: [
      {
        title: "",
        description: "",
      },
    ],

    //----------- for taking_action list input ----------
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

      // Reset JSON data arrays
      this.taking_action_data = [{ ...this.taking_action_data_object }];
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
              $(`#${field.name}`).summernote("code", value[1]);
            }
          });
        });

        if (this.item.taking_action) {
          this.taking_action_data = this.item.taking_action.map(
            (taking_action) => ({
              title: taking_action.title,
              description: taking_action.description,
            })
          );
        }
      }
    },
    submitHandler: async function ($event) {
      if (!this.validate_data()) {
        return; // Stop submission if validation fails
      }

      this.set_only_latest_data(true);
      if (this.param_id) {
        this.setSummerEditor();
        let response = await this.update($event);
        // await this.get_all();
        if ([200, 201].includes(response.status)) {
          window.s_alert("Data successfully updated");
          this.$router.push({ name: `Details${this.setup.route_prefix}` });
        }
      } else {
        this.setSummerEditor();
        let response = await this.create($event);
        // await this.get_all();
        if ([200, 201].includes(response.status)) {
          $event.target.reset();

          // Reset JSON data arrays
          this.taking_action_data = [{ ...this.taking_action_data_object }];

          // Clear summernote editors for all textarea fields
          this.form_fields.forEach((field) => {
            if (field.type === "textarea" && $(`#${field.name}`).length) {
              $(`#${field.name}`).summernote("code", "");
            }
          });
          window.s_alert("Data Successfully Created");
          // this.$router.push({ name: `All${this . setup . route_prefix}` });
        }
      }
    },
    setSummerEditor() {
      // Dynamically set summernote content for all textarea fields
      this.form_fields.forEach((field) => {
        if (field.type === "textarea" && $(`#${field.name}`).length) {
          const markupStr = $(`#${field.name}`).summernote("code");
          // Set the value in the form field object
          field.value = markupStr;
          // Optionally, update a hidden input if your backend expects it
          let $input = $(`#${field.name}_hidden`);
          if ($input.length === 0) {
            $input = $(
              `<input type="hidden" id="${field.name}_hidden" name="${field.name}">`
            );
            $(`#${field.name}`).parent().append($input);
          }
          $input.val(markupStr);
        }
      });
    },

    //add row for json data
    add_row: function (field_name) {
      if (field_name === "taking_action") {
        this.taking_action_data.push({
          ...this.taking_action_data_object,
        });
      }
    },
    //delete row for json data
    delete_row(field_name, index) {
      if (field_name === "taking_action") {
        if (this.taking_action_data.length < 2) {
          alert("cant delete first row");
          return;
        }
        this.taking_action_data.splice(index, 1);
      }
    },

    //validation for social link empty data
    validate_data: function () {
      this.errors = [];
      let valid = true;

      // taking_action json data validation
      this.errors["taking_action"] = [];
      this.taking_action_data.forEach((taking_action, index) => {
        let taking_actionErrors = {};

        // Validate title field
        if (!taking_action.title || String(taking_action.title).trim() === "") {
          taking_actionErrors.title = "Title is required";
          valid = false;
        }
        // Validate description field
        if (
          !taking_action.description ||
          String(taking_action.description).trim() === ""
        ) {
          taking_actionErrors.description = "description is required";
          valid = false;
        }

        this.errors["taking_action"][index] = taking_actionErrors;
      });

      // Log errors for debugging
      console.log(this.errors);

      if (!valid) {
        console.error("Validation failed");
        return false;
      }

      return true;
    },
  },

  computed: {
    ...mapState(store, {
      item: "item",
    }),
  },
};
</script>
