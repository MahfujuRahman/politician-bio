<template>

  <Header />
  <!-- Navbar area Start -->
  <template class="d-lg-block">
    <NavbarArea />
  </template>
  <!-- navbar area end -->
  <div class="container">
    <h1>Election Page</h1>
  </div>
</template>

<script>
import Header from "../../Shared/Header.vue";
import NavbarArea from "../../CommonComponents/NavbarArea.vue";
export default {
  components: { Header, NavbarArea },
};
</script>
