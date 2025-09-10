<template>
  <div>

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
    <!-- banner section start here -->
    <common-banner
      :background-image="'/frontend/assets/img/about-bg.png'"
      :heading="'Terms & Conditions'"
      :breadcrumbs="[
        { text: 'Home', url: '/' },
        { text: 'Terms & Conditions', url: '/single/terms-and-conditions' },
      ]"
      key="terms-and-conditions"
    />
    <!-- banner section End here -->

    <section class="terms-section py-5">
      <div class="container">
        <div class="col-lg-10 mx-auto">
          <h1 class="mb-3">Terms & Conditions</h1>
          <p class="lead">
            These Terms & Conditions govern your use of this website and any
            related services provided by or on behalf of the political leader
            and their campaign/office. By accessing or using the site you agree
            to be bound by these terms.
          </p>

          <nav class="mb-4">
            <strong>On this page:</strong>
            <ul class="toc list-unstyled mb-0">
              <li><a href="#acceptance">1. Acceptance of Terms</a></li>
              <li><a href="#use-of-site">2. Use of the Site</a></li>
              <li><a href="#campaign-materials">3. Campaign Materials</a></li>
              <li><a href="#donations">4. Donations & Contributions</a></li>
              <li><a href="#user-content">5. User Content</a></li>
              <li><a href="#privacy">6. Privacy</a></li>
              <li>
                <a href="#intellectual-property">7. Intellectual Property</a>
              </li>
              <li><a href="#disclaimer">8. Disclaimers</a></li>
              <li><a href="#limitation">9. Limitation of Liability</a></li>
              <li><a href="#changes">10. Changes to Terms</a></li>
              <li><a href="#contact">11. Contact</a></li>
            </ul>
          </nav>

          <article>
            <section id="acceptance" class="mb-4">
              <h4>1. Acceptance of Terms</h4>
              <p>
                By using this website you accept and agree to be bound by these
                Terms & Conditions and our Privacy Policy. If you do not agree,
                you must not use the site.
              </p>
            </section>

            <section id="use-of-site" class="mb-4">
              <h4>2. Use of the Site</h4>
              <p>
                The website and its content are provided for general information
                and outreach related to the political leader and their
                initiatives. You agree to use the site in a lawful manner and
                not to engage in abusive, harassing or otherwise unlawful
                conduct.
              </p>
            </section>

            <section id="campaign-materials" class="mb-4">
              <h4>3. Campaign Materials</h4>
              <p>
                Materials published on this site (statements, photos, videos,
                downloadable resources) are provided for informational and
                campaign purposes. Any endorsement, claim or fundraising page is
                subject to applicable local and national election laws. The
                presence of content on this site does not imply an endorsement
                by third-party organizations unless explicitly stated.
              </p>
            </section>

            <section id="donations" class="mb-4">
              <h4>4. Donations & Contributions</h4>
              <p>
                If you make a donation or contribution via this website you will
                be subject to specific donation terms and local legal
                requirements. All donations are final and non-refundable except
                as required by law. Contributions may be subject to verification
                and eligibility checks.
              </p>
            </section>

            <section id="user-content" class="mb-4">
              <h4>5. User Content</h4>
              <p>
                Visitors may submit comments or other content. By submitting
                content you grant the site a non-exclusive, royalty-free,
                worldwide license to use, reproduce and display that content.
                You represent that you own the content or have permission to
                submit it. The site reserves the right to remove or refuse any
                content that violates these terms.
              </p>
            </section>

            <section id="privacy" class="mb-4">
              <h4>6. Privacy</h4>
              <p>
                The collection and use of personal information through this site
                are described in our Privacy Policy. Please review it to
                understand how we handle personal data.
              </p>
            </section>

            <section id="intellectual-property" class="mb-4">
              <h4>7. Intellectual Property</h4>
              <p>
                All content on the site, including graphics, text, logos and
                images, is owned or licensed by the political leader or their
                campaign unless otherwise stated. You may not reproduce or use
                site content for commercial purposes without prior written
                permission.
              </p>
            </section>

            <section id="disclaimer" class="mb-4">
              <h4>8. Disclaimers</h4>
              <p>
                The site is provided "as is" without warranties of any kind.
                While we aim to keep content accurate and up to date, we do not
                guarantee completeness or accuracy and disclaim liability for
                errors.
              </p>
            </section>

            <section id="limitation" class="mb-4">
              <h4>9. Limitation of Liability</h4>
              <p>
                To the maximum extent permitted by law, the site and its owners
                shall not be liable for any indirect, incidental, consequential
                or punitive damages arising from your access or use of the site.
              </p>
            </section>

            <section id="changes" class="mb-4">
              <h4>10. Changes to Terms</h4>
              <p>
                We may modify these Terms & Conditions at any time. When changes
                are made we will update the "Last updated" date. Your continued
                use of the site after changes constitutes acceptance of those
                changes.
              </p>
            </section>

            <section id="contact" class="mb-4">
              <h4>11. Contact</h4>
              <p>
                If you have questions about these terms, please contact us at
                the addresses below.
              </p>
              <p>
                <strong>Email:</strong> info@example.com<br />
                <strong>Address:</strong> 123 Example Street, City, Country
              </p>
            </section>

            <p class="small text-muted">Last updated: August 26, 2025</p>
          </article>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "../../Shared/Header.vue";
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
import CommonBanner from "../../CommonComponents/CommonBanner.vue";
export default {
  components: { Header, NavbarArea, CommonBanner },
};
</script>

<style scoped>
.terms-section h1 {
  font-size: 32px;
  font-weight: 700;
}
.terms-section .lead {
  font-size: 16px;
  color: #555;
}
.toc a {
  display: inline-block;
  margin-right: 12px;
  color: #007bff;
  text-decoration: none;
}
.toc a:hover {
  text-decoration: underline;
}
</style>
