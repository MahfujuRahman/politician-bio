<template>
  <div class="container-fluid">
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">FAQ Page Headings</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10">
        <div class="card" id="faq_page_headings">
          <div class="card-body">
            <div class="d-flex">
              <ul
                class="flex-column nav nav-tabs nav-tabs-primary top-icon nav-justified card"
              >
                <li class="nav-item" @click="tab = 'faq_faq'">
                  <a
                    :class="tab == 'faq_faq' ? ' active' : ''"
                    href="javascript:void();"
                    data-target="#faq_faq"
                    data-toggle="pill"
                    class="nav-link"
                    ><i class="icon-note"></i>
                    <span class="hidden-xs">FAQ</span></a
                  >
                  <hr />
                </li>
              </ul>
              <div class="ml-2 flex-grow-1 tab-content p-3 card">
                <!-- -------------------------------------------------------- -->
                <!-- --------------------------faq_faq ----------------- -->
                <!-- --------------------------------------------------------- -->
                <div
                  v-if="tab == 'faq_faq'"
                  :class="tab == 'faq_faq' ? ' active' : ''"
                  class="tab-pane active"
                  id="faq_faq"
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
                            'faq_faq',
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
                            'faq_faq',
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
    tab: "faq_faq",
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
