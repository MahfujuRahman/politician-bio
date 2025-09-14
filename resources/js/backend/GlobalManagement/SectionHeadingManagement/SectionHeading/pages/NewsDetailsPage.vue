<template>
  <div class="container-fluid">
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">News Details Page Headings</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10">
        <div class="card" id="news_details_page_headings">
          <div class="card-body">
            <div class="d-flex">
              <ul
                class="flex-column nav nav-tabs nav-tabs-primary top-icon nav-justified card"
              >
               <li class="nav-item" @click="tab = 'news_details_banner'">
                  <a
                    :class="tab == 'news_details_banner' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#news_details_banner"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Banner</span></a
                  >
                  <hr />
                </li>
                <li class="nav-item" @click="tab = 'news_details_news_comment'">
                  <a
                    :class="tab == 'news_details_news_comment' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#news_details_news_comment"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">Comment</span></a
                  >
                  <hr />
                </li>
              </ul>
              <div class="ml-2 flex-grow-1 tab-content p-3 card">
                <!-- -------------------------------------------------------- -->
                <!-- --------------------------news_details_banner ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'news_details_banner'"
                  :class="tab == 'news_details_banner' ? ' active' : ''"
                  class="tab-pane active"
                  id="news_details_banner"
                >
                  <form
                    @submit.prevent="SectionHeadingHandler"
                    enctype="multipart/form-data"
                  >
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
                            'news_details_banner',
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
                              'news_details_banner',
                              'background_image'
                            )
                          "
                          class="mt-2"
                          :src="`${get_heading_value(
                            'news_details_banner',
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
                <!-- --------------------------news_details_news_comment ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'news_details_news_comment'"
                  :class="tab == 'news_details_news_comment' ? ' active' : ''"
                  class="tab-pane active"
                  id="news_details_news_comment"
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
                            'news_details_news_comment',
                            'short_title'
                          )}`"
                          placeholder="Enter short title"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"
                        >Special Note</label
                      >
                      <div class="col-lg-9">
                        <input
                          name="special_note"
                          class="form-control"
                          type="text"
                          :value="`${get_heading_value(
                            'news_details_news_comment',
                            'special_note'
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
    tab: "news_details_banner",
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
