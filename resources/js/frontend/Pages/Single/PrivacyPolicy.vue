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
      :heading="'Privacy Policy'"
      :breadcrumbs="[
        { text: 'Home', url: '/' },
        { text: 'Privacy Policy', url: '/single/privacy-policy' },
      ]"
      key="privacy-policy"
    />
    <!-- banner section End here -->

    <section class="privacy-policy-section py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="mb-3">Privacy Policy</h1>
            <p class="lead mb-4">
              This Privacy Policy explains how we collect, use, disclose, and
              safeguard your information when you visit our website. Please read
              this policy carefully. If you do not agree with the terms of this
              privacy policy, please do not access the site.
            </p>

            <nav class="mb-4">
              <strong>On this page:</strong>
              <ul class="toc list-unstyled mb-0">
                <li><a href="#collect">1. Information We Collect</a></li>
                <li><a href="#use">2. How We Use Information</a></li>
                <li><a href="#cookies">3. Cookies & Tracking</a></li>
                <li><a href="#sharing">4. Sharing Your Information</a></li>
                <li><a href="#security">5. Data Security</a></li>
                <li><a href="#rights">6. Your Rights</a></li>
                <li><a href="#contact">7. Contact Us</a></li>
              </ul>
            </nav>

            <article>
              <section id="collect" class="mb-4">
                <h4>1. Information We Collect</h4>
                <p>
                  We may collect information about you in a variety of ways. The
                  information we may collect on the Site includes:
                </p>
                <ul>
                  <li>Personal Data (name, email, contact details)</li>
                  <li>Usage Data (pages visited, IP address, browser type)</li>
                  <li>Content you submit (comments, form submissions)</li>
                </ul>
              </section>

              <section id="use" class="mb-4">
                <h4>2. How We Use Information</h4>
                <p>We use the information we collect for purposes such as:</p>
                <ul>
                  <li>Providing and maintaining the website</li>
                  <li>Responding to inquiries or support requests</li>
                  <li>Analyzing site usage to improve content and features</li>
                </ul>
              </section>

              <section id="cookies" class="mb-4">
                <h4>3. Cookies & Tracking</h4>
                <p>
                  We use cookies and similar tracking technologies to track the
                  activity on our Site and hold certain information. You can set
                  your browser to refuse all or some browser cookies.
                </p>
              </section>

              <section id="sharing" class="mb-4">
                <h4>4. Sharing Your Information</h4>
                <p>
                  We will not sell, rent or lease your personal information to
                  third parties. We may share information with service providers
                  who perform services on our behalf, or when required by law.
                </p>
              </section>

              <section id="security" class="mb-4">
                <h4>5. Data Security</h4>
                <p>
                  We take reasonable measures to protect your information, but
                  no internet transmission or electronic storage is 100% secure.
                </p>
              </section>

              <section id="rights" class="mb-4">
                <h4>6. Your Rights</h4>
                <p>
                  Depending on your jurisdiction, you may have rights regarding
                  your personal data, including the right to access, correct, or
                  delete your information.
                </p>
              </section>

              <section id="contact" class="mb-4">
                <h4>7. Contact Us</h4>
                <p>
                  If you have questions about this Privacy Policy, please
                  contact us at:
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
.privacy-policy-section h1 {
  font-size: 32px;
  font-weight: 700;
}
.privacy-policy-section .lead {
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
