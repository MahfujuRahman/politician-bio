<template>
  <div class="container-fluid">
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">Contact Us Page Headings</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10">
        <div class="card" id="contact_us_page_headings">
          <div class="card-body">
            <div class="d-flex">
              <ul
                class="flex-column nav nav-tabs nav-tabs-primary top-icon nav-justified card"
              >
                <li
                  class="nav-item"
                  @click="tab = 'contact_us_contact_address'"
                >
                  <a
                    :class="
                      tab == 'contact_us_contact_address' ? ' active' : ''
                    "
                    href="javascript:void();"
                    data-target="#contact_us_contact_address"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Contact Address</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'contact_us_contact_people'">
                  <a
                    :class="tab == 'contact_us_contact_people' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#contact_us_contact_people"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Contact People</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'contact_us_map_location'">
                  <a
                    :class="tab == 'contact_us_map_location' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#contact_us_map_location"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Map Location</span></a
                  >
                  <hr />
                </li>
              </ul>
              <div class="ml-2 flex-grow-1 tab-content p-3 card">
                <!-- -------------------------------------------------------- -->
                <!-- --------------------------contact_us_contact_address ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'contact_us_contact_address'"
                  :class="tab == 'contact_us_contact_address' ? ' active' : ''"
                  class="tab-pane active"
                  id="contact_us_contact_address"
                >
                  <form
                    @submit.prevent="SectionHeadingHandler"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Short Title</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="short_title"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'contact_us_contact_address',
                            'short_title'
                          )}`"
                          placeholder="Enter short title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Long Title</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="long_title"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'contact_us_contact_address',
                            'long_title'
                          )}`"
                          placeholder="Enter long title"
                        />
                      </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group row">
                      <label
                        class="col-lg-3 col-form-label form-control-label"
                      ></label>
                      <div class="col-lg-9">
                        <input
                          type="submit"
                          class="btn btn-primary"
                          value="Save Changes"
                        />
                      </div>
                    </div>
                  </form>
                </div>

                <!-- -------------------------------------------------------- -->
                <!-- --------------------------contact_us_contact_people ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'contact_us_contact_people'"
                  :class="tab == 'contact_us_contact_people' ? ' active' : ''"
                  class="tab-pane active"
                  id="contact_us_contact_people"
                >
                  <form
                    @submit.prevent="SectionHeadingHandler"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Short Title</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="short_title"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'contact_us_contact_people',
                            'short_title'
                          )}`"
                          placeholder="Enter short title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Long Title</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="long_title"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'contact_us_contact_people',
                            'long_title'
                          )}`"
                          placeholder="Enter long title"
                        />
                      </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group row">
                      <label
                        class="col-lg-3 col-form-label form-control-label"
                      ></label>
                      <div class="col-lg-9">
                        <input
                          type="submit"
                          class="btn btn-primary"
                          value="Save Changes"
                        />
                      </div>
                    </div>
                  </form>
                </div>

                <!-- -------------------------------------------------------- -->
                <!-- -------------------- contact_us_map_location ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'contact_us_map_location'"
                  :class="tab == 'contact_us_map_location' ? ' active' : ''"
                  class="tab-pane active"
                  id="contact_us_map_location"
                >
                  <form
                    @submit.prevent="SectionHeadingHandler"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Short Title</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="short_title"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'contact_us_map_location',
                            'short_title'
                          )}`"
                          placeholder="Enter short title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Long Title</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="long_title"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'contact_us_map_location',
                            'long_title'
                          )}`"
                          placeholder="Enter long title"
                        />
                      </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group row">
                      <label
                        class="col-lg-3 col-form-label form-control-label"
                      ></label>
                      <div class="col-lg-9">
                        <input
                          type="submit"
                          class="btn btn-primary"
                          value="Save Changes"
                        />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End container-fluid-->
</template>

<script>
import { section_heading_store } from "../store/section_heading_store";
import { mapState, mapActions } from "pinia";
export default {
  data: () => ({
    tab: "contact_us_contact_address",
  }),
  created() {
    this.get_all_section_headings();
  },

  methods: {
    ...mapActions(section_heading_store, {
      get_all_section_headings: "get_all_section_headings",
      get_heading_value: "get_heading_value",
    }),
    SectionHeadingHandler: async function (event) {
      try {
        let formData = new FormData(event.target);
        formData.append("section_type", this.tab);

        let response = await axios.post("section-headings/store", formData);
        if (response.data.status == "success") {
          window.s_alert(response.data.message);
          this.get_all_section_headings();
        } else {
          window.s_warning(response.data.message);
        }
      } catch (err) {
        console.error(err);
        window.s_warning("An error occurred. Check console for details.");
      }
    },
  },
  computed: {
    ...mapState(section_heading_store, {
      all_data: "all_data",
    }),
  },
  watch: {
    all_data: {
      handler: function () {
        // this.get_all_website_settings();
      },
    },
  },
};
</script>

<style></style>
