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

            <!-- for facts_and_features list input start-->
            <div class="col-md-12 pt-3">
              <div
                class="d-flex justify-content-between align-items-center pb-2 section-title"
              >
                <h5 class="m-0">Add Statistics</h5>
                <button
                  class="btn btn-sm btn-outline-success"
                  @click.prevent="add_row('statistics')"
                >
                  Add row
                </button>
              </div>
              <div
                class="row align-items-center justify-content-start"
                v-for="(statistics, index) in statistics_data"
                :key="index"
              >
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">title</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`statistics[${index}][title]`"
                        v-model="statistics.title"
                        id="title"
                        :class="{
                          custom_error:
                            errors['statistics'] &&
                            errors['statistics'][index] &&
                            errors['statistics'][index].title,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['statistics'] &&
                        errors['statistics'][index] &&
                        errors['statistics'][index].title
                      "
                      class="text-danger small"
                    >
                      {{ errors["statistics"][index].title }}
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">percent</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="number"
                        :name="`statistics[${index}][percent]`"
                        v-model="statistics.percent"
                        id="percent"
                        :class="{
                          custom_error:
                            errors['statistics'] &&
                            errors['statistics'][index] &&
                            errors['statistics'][index].percent,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['statistics'] &&
                        errors['statistics'][index] &&
                        errors['statistics'][index].percent
                      "
                      class="text-danger small"
                    >
                      {{ errors["statistics"][index].percent }}
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
                        !errors['statistics']?.[index]?.title &&
                        !errors['statistics']?.[index]?.percent
                          ? '30px'
                          : '0',
                    }"
                    @click.prevent="delete_row('statistics', index)"
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
import { iconList } from "../../../../GlobalStore/icon_list";

export default {
  components: {},

  data: () => ({
    setup,
    form_fields,
    param_id: null,
    iconList,
    errors: {},
    //----------- for statistics list input ----------

    statistics_data_object: {
      title: "",
      percent: "",
    },
    statistics_data: [
      {
        title: "",
        percent: "",
      },
    ],

    //----------- for statistics list input ----------
  }),
  created: async function () {
    let id = (this.param_id = this.$route.params.id);
    this.reset_fields();

    // Fetch all icons for the select input
    await this.get_all_icon();

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
      this.statistics_data = [{ ...this.statistics_data_object }];
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

        if (this.item.statistics) {
          this.statistics_data = this.item.statistics.map((statistics) => ({
            title: statistics.title,
            percent: statistics.percent,
          }));
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
          this.statistics_data = [{ ...this.statistics_data_object }];
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
      if (field_name === "statistics") {
        this.statistics_data.push({
          ...this.statistics_data_object,
        });
      }
    },
    //delete row for json data
    delete_row(field_name, index) {
      if (field_name === "statistics") {
        if (this.statistics_data.length < 2) {
          alert("cant delete first row");
          return;
        }
        this.statistics_data.splice(index, 1);
      }
    },

    //validation for social link empty data
    validate_data: function () {
      this.errors = [];
      let valid = true;

      // statistics json data validation
      this.errors["statistics"] = [];
      this.statistics_data.forEach((statistics, index) => {
        let statisticsErrors = {};

        // Validate title field
        if (!statistics.title || String(statistics.title).trim() === "") {
          statisticsErrors.title = "title is required";
          valid = false;
        }
        // Validate percent field
        if (!statistics.percent || String(statistics.percent).trim() === "") {
          statisticsErrors.percent = "percent is required";
          valid = false;
        } else if (
          isNaN(String(statistics.percent).trim()) ||
          String(statistics.percent).trim() === ""
        ) {
          statisticsErrors.percent = "percent must be a number";
          valid = false;
        }

        this.errors["statistics"][index] = statisticsErrors;
      });

      // Log errors for debugging
      console.log(this.errors);

      if (!valid) {
        console.error("Validation failed");
        return false;
      }

      return true;
    },

    get_all_icon: async function () {
      let icon_list = this.iconList;
      let item_index = this.form_fields.findIndex(
        (item) => item.name == "icon"
      );
      this.form_fields[item_index].data_list = [];
      icon_list.forEach((item) => {
        let dataList = {};
        dataList.label = item.name;
        dataList.value = item.value;
        this.form_fields[item_index].data_list.push(dataList);
      });
    },
  },

  computed: {
    ...mapState(store, {
      item: "item",
    }),
  },
};
</script>
