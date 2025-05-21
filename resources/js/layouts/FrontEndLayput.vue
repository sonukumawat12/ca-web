<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import FloatingWhatsapp from '@/components/FloatingWhatsapp.vue';

const drawer = ref(false)
const menuItems = [
  { title: 'Home', icon: 'mdi-home', route: route('home') },
  { title: 'About', icon: 'mdi-information', route: route('about') },
  { title: 'Services', icon: 'mdi-cog', route: route('services') },
  { title: 'Pricing', icon: 'mdi-currency-usd', route: route('pricing') },
  { title: 'Blog', icon: 'mdi-post', route: route('blog') },
  { title: 'Contact', icon: 'mdi-email', route: route('contact') },
  { title: 'Style Guide', icon: 'mdi-palette', route: route('style-guide') }
]
</script>

<template>
  <v-app>
    <!-- Mobile Navigation Drawer -->
    <v-navigation-drawer
      v-model="drawer"
      temporary
      elevation="4"
      class="py-4"
    >
      <v-list>
        <v-list-item
          prepend-avatar="/images/ca.png"
          title="CA Solutions"
          subtitle="Expert Services"
          class="mb-4"
        ></v-list-item>

        <v-divider class="mb-2"></v-divider>

        <v-list-item
          v-for="item in menuItems"
          :key="item.title"
          :title="item.title"
          :prepend-icon="item.icon"
          :href="item.route"
          link
          class="mb-1"
          rounded="lg"
        ></v-list-item>
      </v-list>
    </v-navigation-drawer>

    <!-- App Bar / Navbar -->
    <v-app-bar
      flat
      class="px-3"
      height="100"
      color="white"
      elevation="1"
    >
      <template v-slot:prepend>
        <v-app-bar-nav-icon
          class="hidden-md-and-up"
          @click="drawer = !drawer"
        ></v-app-bar-nav-icon>

        <div class="d-flex align-center">
          <Link :href="route('home')" class="text-decoration-none">
            <!-- <v-img src="/images/logo.png" alt="logo" class="navbar-logo" contain></v-img>/ -->
            <img src="/images/logo.png" alt="logo" class="navbar-logo" contain>
          </Link>
        </div>
      </template>

      <!-- Desktop Navigation Menu -->
      <template v-slot:append>
        <div class="hidden-sm-and-down">
          <Link
            v-for="item in menuItems"
            :key="item.title"
            :href="item.route"
            class="text-decoration-none"
          >
            <v-btn
              variant="text"
              class="mx-1 text-capitalize nav-btn font-weight-medium"
              :ripple="false"
            >
              {{ item.title }}
            </v-btn>
          </Link>

          <v-btn
            class="ml-4 text-capitalize gradient-btn"
            elevation="0"
          >
            Get Started
            <v-icon end icon="mdi-arrow-right" class="ml-1"></v-icon>
          </v-btn>
        </div>
      </template>
    </v-app-bar>

    <v-main class="bg-grey-lighten-4">
      <slot />
    </v-main>

    <FloatingWhatsapp />
  </v-app>
</template>

<style scoped>
.v-btn {
  letter-spacing: 0.3px;
  font-size: 0.95rem;
}

.v-btn::before {
  background-color: transparent;
}

.nav-btn {
  color: #0F172A;
  transition: all 0.3s ease;
  height: 40px;
  padding: 0 16px;
}

.nav-btn:hover {
  color: #2563EB;
  background: rgba(37, 99, 235, 0.05);
}

.gradient-btn {
  background: linear-gradient(135deg, #2563EB, #7C3AED) !important;
  color: white !important;
  height: 40px;
  padding: 0 24px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.gradient-btn:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.gradient-text {
  background: linear-gradient(135deg, #2563EB, #7C3AED);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 1.5rem;
}

.text-secondary {
  color: #0F172A;
}

.navbar-logo {
  max-height: 120px;
  max-width: 180px;
  width: auto;
  height: auto;
  display: block;
}
</style>
