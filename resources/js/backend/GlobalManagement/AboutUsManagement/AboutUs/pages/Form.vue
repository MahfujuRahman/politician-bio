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

            <!-- for features list input start-->
            <div class="col-md-12 pt-3">
              <div
                class="d-flex justify-content-between align-items-center pb-2 section-title"
              >
                <h5 class="m-0">Add features</h5>
                <button
                  class="btn btn-sm btn-outline-success"
                  @click.prevent="add_row('features')"
                >
                  Add row
                </button>
              </div>
              <div
                class="row align-items-center justify-content-start"
                v-for="(features, index) in features_data"
                :key="index"
              >
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="">title</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`features[${index}][title]`"
                        v-model="features.title"
                        id="title"
                        :class="{
                          custom_error:
                            errors['features'] &&
                            errors['features'][index] &&
                            errors['features'][index].title,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['features'] &&
                        errors['features'][index] &&
                        errors['features'][index].title
                      "
                      class="text-danger small"
                    >
                      {{ errors["features"][index].title }}
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-2 d-flex align-items-center justify-content-center"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    :style="{
                      width: '50%',
                      marginTop: !errors['features']?.[index]?.title
                        ? '30px'
                        : '0',
                    }"
                    @click.prevent="delete_row('features', index)"
                  >
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- for facts_figures list input start-->
            <div class="col-md-12 pt-3">
              <div
                class="d-flex justify-content-between align-items-center pb-2 section-title"
              >
                <h5 class="m-0">Add facts_figures</h5>
                <button
                  class="btn btn-sm btn-outline-success"
                  @click.prevent="add_row('facts_figures')"
                >
                  Add row
                </button>
              </div>
              <div
                class="row align-items-center"
                v-for="(facts_figures, index) in facts_figures_data"
                :key="index"
              >
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">title</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`facts_figures[${index}][title]`"
                        v-model="facts_figures.title"
                        id="title"
                        :class="{
                          custom_error:
                            errors['facts_figures'] &&
                            errors['facts_figures'][index] &&
                            errors['facts_figures'][index].title,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['facts_figures'] &&
                        errors['facts_figures'][index] &&
                        errors['facts_figures'][index].title
                      "
                      class="text-danger small"
                    >
                      {{ errors["facts_figures"][index].title }}
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">number</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="number"
                        :name="`facts_figures[${index}][number]`"
                        v-model="facts_figures.number"
                        id="number"
                        :class="{
                          custom_error:
                            errors['facts_figures'] &&
                            errors['facts_figures'][index] &&
                            errors['facts_figures'][index].number,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['facts_figures'] &&
                        errors['facts_figures'][index] &&
                        errors['facts_figures'][index].number
                      "
                      class="text-danger small"
                    >
                      {{ errors["facts_figures"][index].number }}
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">unit</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`facts_figures[${index}][unit]`"
                        v-model="facts_figures.unit"
                        id="unit"
                        :class="{
                          custom_error:
                            errors['facts_figures'] &&
                            errors['facts_figures'][index] &&
                            errors['facts_figures'][index].unit,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['facts_figures'] &&
                        errors['facts_figures'][index] &&
                        errors['facts_figures'][index].unit
                      "
                      class="text-danger small"
                    >
                      {{ errors["facts_figures"][index].unit }}
                    </div>
                  </div>
                </div>

                <div
                  class="col-md-2 d-flex align-items-center justify-content-center"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    :style="{
                      width: '50%',
                      marginTop:
                        !errors['facts_figures']?.[index]?.title &&
                        !errors['facts_figures']?.[index]?.number &&
                        !errors['facts_figures']?.[index]?.unit
                          ? '30px'
                          : '0',
                    }"
                    @click.prevent="delete_row('facts_figures', index)"
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

export default {
  components: {},

  data: () => ({
    setup,
    form_fields,
    param_id: null,
    errors: [],

    //----------- for features list input ----------
    features_data_object: {
      title: "",
    },
    features_data: [
      {
        title: "",
      },
    ],

    //----------- for features list input ----------

    //----------- for facts_figures list input ----------
    facts_figures_data_object: {
      title: "",
      number: "",
    },
    facts_figures_data: [
      {
        title: "",
        number: "",
        unit: "",
      },
    ],
    //----------- for facts_figures list input ----------
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
      this.features_data = [{ ...this.features_data_object }];
      this.facts_figures_data = [{ ...this.facts_figures_data_object }];
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

        if (this.item.features) {
          this.features_data = this.item.features.map((features) => ({
            title: features.title,
          }));
        }
        if (this.item.facts_figures) {
          this.facts_figures_data = this.item.facts_figures.map(
            (facts_figures) => ({
              title: facts_figures.title,
              number: facts_figures.number,
              unit: facts_figures.unit,
            })
          );
        }
      }
    },
    submitHandler: async function ($event) {
      // if json data is not valid, stop submission
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
          this.features_data = [{ ...this.features_data_object }];
          this.facts_figures_data = [{ ...this.facts_figures_data_object }];
          
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
      if (field_name === "features") {
        this.features_data.push({
          ...this.features_data_object,
        });
      } else if (field_name === "facts_figures") {
        this.facts_figures_data.push({ ...this.facts_figures_data_object });
      }
    },
    //delete row for json data
    delete_row(field_name, index) {
      if (field_name === "features") {
        if (this.features_data.length < 2) {
          alert("cant delete first row");
          return;
        }
        this.features_data.splice(index, 1);
      } else if (field_name === "facts_figures") {
        if (this.facts_figures_data.length < 2) {
          alert("cant delete first row");
          return;
        }
        this.facts_figures_data.splice(index, 1);
      }
    },

    //validation for social link empty data
    validate_data: function () {
      this.errors = [];
      let valid = true;

      // features json data validation
      this.errors["features"] = [];
      this.features_data.forEach((features, index) => {
        let featuresErrors = {};

        // Validate title field
        if (!features.title || String(features.title).trim() === "") {
          featuresErrors.title = "Title is required";
          valid = false;
        }

        this.errors["features"][index] = featuresErrors;
      });

      // facts_figures json data validation
      this.errors["facts_figures"] = [];
      this.facts_figures_data.forEach((facts_figures, index) => {
        let facts_figuresErrors = {};

        // Validate title field
        if (!facts_figures.title) {
          facts_figuresErrors.title = "title is required";
          valid = false;
        }
        // Validate number field
        if (
          !facts_figures.number ||
          facts_figures.number === null ||
          facts_figures.number === undefined
        ) {
          facts_figuresErrors.number = "number is required";
          valid = false;
        }
        // Validate unit field
        if (
          !facts_figures.unit ||
          facts_figures.unit === null ||
          facts_figures.unit === undefined
        ) {
          facts_figuresErrors.unit = "unit is required";
          valid = false;
        }

        this.errors["facts_figures"][index] = facts_figuresErrors;
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
