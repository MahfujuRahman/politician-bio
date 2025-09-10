<template>
  <div class="container-fluid">
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">Services Page Headings</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10">
        <div class="card" id="services_page_headings">
          <div class="card-body">
            <div class="d-flex">
              <ul
                class="flex-column nav nav-tabs nav-tabs-primary top-icon nav-justified card"
              >
                <li class="nav-item" @click="tab = 'services_services'">
                  <a
                    :class="tab == 'services_services' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#services_services"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Service</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'services_public_comments'">
                  <a
                    :class="tab == 'services_public_comments' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#services_public_comments"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Public Comments</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'services_news'">
                  <a
                    :class="tab == 'services_news' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#services_news"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">News</span></a
                  >
                  <hr />
                </li>
              </ul>
              <div class="ml-2 flex-grow-1 tab-content p-3 card">
                <!-- -------------------------------------------------------- -->
                <!-- --------------------------services_services ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'services_services'"
                  :class="tab == 'services_services' ? ' active' : ''"
                  class="tab-pane active"
                  id="services_services"
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
                            'services_services',
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
                            'services_services',
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
                <!-- --------------------------services_public_comments ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'services_public_comments'"
                  :class="tab == 'services_public_comments' ? ' active' : ''"
                  class="tab-pane active"
                  id="services_public_comments"
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
                            'services_public_comments',
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
                            'services_public_comments',
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
                              'services_public_comments',
                              'primary_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'services_public_comments',
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
                              'services_public_comments',
                              'background_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'services_public_comments',
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
                <!-- --------------------------services_news ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'services_news'"
                  :class="tab == 'services_news' ? ' active' : ''"
                  class="tab-pane active"
                  id="services_news"
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
                            'services_news',
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
                            'services_news',
                            'title'
                          )}`"
                          placeholder="Enter title"
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
    tab: "services_services",
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
