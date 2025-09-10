<template>
  <div class="container-fluid">
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">Home Page Headings</h4>
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
                <li class="nav-item" @click="tab = 'home_service'">
                  <a
                    :class="tab == 'home_service' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#home_service"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Service</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'home_why_chose_us'">
                  <a
                    :class="tab == 'home_why_chose_us' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#home_why_chose_us"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Why Choose Us</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'home_principles'">
                  <a
                    :class="tab == 'home_principles' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#home_principles"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Principles</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'home_media_coverage'">
                  <a
                    :class="tab == 'home_media_coverage' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#home_media_coverage"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Media Coverage</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'home_donation'">
                  <a
                    :class="tab == 'home_donation' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#home_donation"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Donation</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'home_public_comments'">
                  <a
                    :class="tab == 'home_public_comments' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#home_public_comments"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Public Comments</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'home_news'">
                  <a
                    :class="tab == 'home_news' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#home_news"
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
                <!-- --------------------------home_service ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'home_service'"
                  :class="tab == 'home_service' ? ' active' : ''"
                  class="tab-pane active"
                  id="home_service"
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
                            'home_service',
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
                            'home_service',
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
                <!-- --------------------------home_why_chose_us ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'home_why_chose_us'"
                  :class="tab == 'home_why_chose_us' ? ' active' : ''"
                  class="tab-pane active"
                  id="home_why_chose_us"
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
                            'home_why_chose_us',
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
                            'home_why_chose_us',
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
                              'home_why_chose_us',
                              'primary_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'home_why_chose_us',
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
                              'home_why_chose_us',
                              'background_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'home_why_chose_us',
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
                <!-- --------------------------home_principles ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'home_principles'"
                  :class="tab == 'home_principles' ? ' active' : ''"
                  class="tab-pane active"
                  id="home_principles"
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
                            'home_principles',
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
                            'home_principles',
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
                <!-- --------------------------home_media_coverage ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'home_media_coverage'"
                  :class="tab == 'home_media_coverage' ? ' active' : ''"
                  class="tab-pane active"
                  id="home_media_coverage"
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
                            'home_media_coverage',
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
                            'home_media_coverage',
                            'title'
                          )}`"
                          placeholder="Enter title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Video URL (youtube link)</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="video_url"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'home_media_coverage',
                            'video_url'
                          )}`"
                          placeholder="Enter video URL"
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
                              'home_media_coverage',
                              'background_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'home_media_coverage',
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
                <!-- --------------------------home_donation ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'home_donation'"
                  :class="tab == 'home_donation' ? ' active' : ''"
                  class="tab-pane active"
                  id="home_donation"
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
                            'home_donation',
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
                            'home_donation',
                            'title'
                          )}`"
                          placeholder="Enter title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Short description</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="short_description"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'home_donation',
                            'short_description'
                          )}`"
                          placeholder="Enter short description"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Side Image</label
                      >
                      <div class="col-lg-9">
                        <input
                          class="form-control"
                          name="side_image"
                          type="file"
                        />
                        <img
                          v-if="
                            get_heading_value(
                              'home_donation',
                              'side_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'home_donation',
                            'side_image'
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
                <!-- --------------------------home_public_comments ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'home_public_comments'"
                  :class="tab == 'home_public_comments' ? ' active' : ''"
                  class="tab-pane active"
                  id="home_public_comments"
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
                            'home_public_comments',
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
                            'home_public_comments',
                            'title'
                          )}`"
                          placeholder="Enter title"
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
                              'home_public_comments',
                              'background_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'home_public_comments',
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
                <!-- --------------------------home_news ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'home_news'"
                  :class="tab == 'home_news' ? ' active' : ''"
                  class="tab-pane active"
                  id="home_news"
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
                            'home_news',
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
                            'home_news',
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
    tab: "home_service",
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
