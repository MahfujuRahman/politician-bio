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
            <event-drop-down-el
              :name="'event_id'"
              :multiple="false"
              :value="item.event_id"
            />
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
            <!-- for social_link list input start-->
            <div class="col-md-12 pt-3">
              <div
                class="d-flex justify-content-between align-items-center pb-2 section-title"
              >
                <h5 class="m-0">Add Social link</h5>
                <button
                  class="btn btn-sm btn-outline-success"
                  @click.prevent="add_row('social_link')"
                >
                  Add row
                </button>
              </div>
              <div
                class="row align-items-center justify-content-start"
                v-for="(social_link, index) in social_link_data"
                :key="index"
              >
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">icon</label>
                    <div class="mt-1 mb-3">
                      <select
                        class="form-control form-control-square mb-2"
                        :name="`social_link[${index}][icon]`"
                        v-model="social_link.icon"
                        :class="{
                          custom_error:
                            errors['social_link'] &&
                            errors['social_link'][index] &&
                            errors['social_link'][index].icon,
                        }"
                      >
                        <option value="">-- select --</option>
                        <option
                          v-for="(icon, i) in icons"
                          :key="i"
                          :value="icon.value"
                        >
                          {{ icon.name }}
                        </option>
                      </select>
                      <div
                        v-if="
                          errors['social_link'] &&
                          errors['social_link'][index] &&
                          errors['social_link'][index].icon
                        "
                        class="text-danger small"
                      >
                        {{ errors["social_link"][index].icon }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">link</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`social_link[${index}][link]`"
                        v-model="social_link.link"
                        id="link"
                        :class="{
                          custom_error:
                            errors['social_link'] &&
                            errors['social_link'][index] &&
                            errors['social_link'][index].link,
                        }"
                      />
                    </div>
                    <div
                      v-if="
                        errors['social_link'] &&
                        errors['social_link'][index] &&
                        errors['social_link'][index].link
                      "
                      class="text-danger small"
                    >
                      {{ errors["social_link"][index].link }}
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
                        !errors['social_link']?.[index]?.icon &&
                        !errors['social_link']?.[index]?.link
                          ? '30px'
                          : '0',
                    }"
                    @click.prevent="delete_row('social_link', index)"
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

import EventDropDownEl from "../../Event/components/dropdown/DropDownEl.vue";
import { iconList } from "../../../../GlobalStore/social_icon_list";

export default {
  components: { EventDropDownEl },

  data: () => ({
    setup,
    form_fields,
    param_id: null,
    errors: {},
    icons: iconList,

    //----------- for social_link list input ----------

    social_link_data_object: {
      icon: "",
      link: "",
    },
    social_link_data: [
      {
        icon: "",
        link: "",
      },
    ],

    //----------- for social_link list input ----------
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
      this.social_link_data = [{ ...this.social_link_data_object }];
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

        if (this.item.social_link) {
          this.social_link_data = this.item.social_link.map((social_link) => ({
            icon: social_link.icon,
            link: social_link.link,
          }));
        }
      }
    },
    submitHandler: async function ($event) {
      // Validate the json data before submission
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
          this.social_link_data = [{ ...this.social_link_data_object }];

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
      if (field_name === "social_link") {
        this.social_link_data.push({
          ...this.social_link_data_object,
        });
      }
    },
    //delete row for json data
    delete_row(field_name, index) {
      if (field_name === "social_link") {
        if (this.social_link_data.length < 2) {
          alert("cant delete first row");
          return;
        }
        this.social_link_data.splice(index, 1);
      }
    },

    //validation for social link empty data
    validate_data: function () {
      this.errors = [];
      let valid = true;

      // social_link json data validation
      this.errors["social_link"] = [];
      this.social_link_data.forEach((social_link, index) => {
        let social_linkErrors = {};

        // Validate icon field
        if (!social_link.icon || String(social_link.icon).trim() === "") {
          social_linkErrors.icon = "icon is required";
          valid = false;
        }
        // Validate link field
        if (!social_link.link || String(social_link.link).trim() === "") {
          social_linkErrors.link = "Link is required";
          valid = false;
        }

        this.errors["social_link"][index] = social_linkErrors;
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
