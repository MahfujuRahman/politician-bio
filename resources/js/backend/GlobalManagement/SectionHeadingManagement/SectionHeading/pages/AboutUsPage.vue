<template>
  <div class="container-fluid">
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">About Us Headings</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10">
        <div class="card" id="home_page_headings">
          <div class="card-body">
            <div class="d-flex">
              <ul
                class="flex-column nav nav-tabs nav-tabs-primary top-icon nav-justified card"
              >
                <li class="nav-item" @click="tab = 'about_us_volunteer'">
                  <a
                    :class="tab == 'about_us_volunteer' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#about_us_volunteer"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Volunteer</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'about_us_why_chose_us'">
                  <a
                    :class="tab == 'about_us_why_chose_us' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#about_us_why_chose_us"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Why Choose Us</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'about_us_mission_vision'">
                  <a
                    :class="tab == 'about_us_mission_vision' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#about_us_mission_vision"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Mission Vision</span></a
                  >
                  <hr />
                </li>
              </ul>
              <div class="ml-2 flex-grow-1 tab-content p-3 card">
                <!-- -------------------------------------------------------- -->
                <!-- --------------------------about_us_volunteer ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'about_us_volunteer'"
                  :class="tab == 'about_us_volunteer' ? ' active' : ''"
                  class="tab-pane active"
                  id="about_us_volunteer"
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
                            'about_us_volunteer',
                            'short_title'
                          )}`"
                          placeholder="Enter short title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Title</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="title"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'about_us_volunteer',
                            'title'
                          )}`"
                          placeholder="Enter title"
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
                            'about_us_volunteer',
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
                <!-- --------------------------about_us_why_chose_us ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'about_us_why_chose_us'"
                  :class="tab == 'about_us_why_chose_us' ? ' active' : ''"
                  class="tab-pane active"
                  id="about_us_why_chose_us"
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
                            'about_us_why_chose_us',
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
                            'about_us_why_chose_us',
                            'long_title'
                          )}`"
                          placeholder="Enter long title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Primary Image</label
                      >
                      <div class="col-lg-9">
                        <input
                          class="form-control"
                          name="primary_image"
                          type="file"
                        />
                        <img
                          v-if="
                            get_heading_value(
                              'about_us_why_chose_us',
                              'primary_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'about_us_why_chose_us',
                            'primary_image'
                          )}`"
                          height="100"
                          width="100"
                          alt=""
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Background Image</label
                      >
                      <div class="col-lg-9">
                        <input
                          class="form-control"
                          name="background_image"
                          type="file"
                        />
                        <img
                          v-if="
                            get_heading_value(
                              'about_us_why_chose_us',
                              'background_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'about_us_why_chose_us',
                            'background_image'
                          )}`"
                          height="100"
                          width="100"
                          alt=""
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
                <!-- --------------------------about_us_mission_vision ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'about_us_mission_vision'"
                  :class="tab == 'about_us_mission_vision' ? ' active' : ''"
                  class="tab-pane active"
                  id="about_us_mission_vision"
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
                            'about_us_mission_vision',
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
                            'about_us_mission_vision',
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
    tab: "about_us_volunteer",
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
