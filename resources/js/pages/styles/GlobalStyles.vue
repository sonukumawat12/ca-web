<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { computed } from 'vue';

// Enhanced Color scheme constants
const colors = {
  primary: '#2563EB',    // Rich Blue - Primary brand color
  secondary: '#0F172A',  // Deep Navy - Text and headings
  accent: '#7C3AED',     // Vibrant Purple - Accent color
  success: '#059669',    // Emerald - Success states
  warning: '#D97706',    // Amber - Warning states
  error: '#DC2626',      // Red - Error states
  grey: '#64748B',       // Slate - Secondary text
  lightGrey: '#F1F5F9',  // Cool Grey - Background
  white: '#FFFFFF',      // White - Text on dark backgrounds
  gradient: {
    start: '#2563EB',    // Primary Blue
    end: '#7C3AED'       // Accent Purple
  }
}

// Computed property to filter string colors
const stringColors = computed(() => {
  return Object.entries(colors)
    .filter(([_, value]) => typeof value === 'string')
    .reduce((acc, [key, value]) => ({ ...acc, [key]: value }), {});
});
</script>

<template>
  <AppLayout>
    <v-container class="py-16">
      <div class="style-guide">
        <h1 class="text-h3 font-weight-bold mb-8">Design System</h1>

        <!-- Color Palette Section -->
        <div class="section mb-8">
          <h2 class="section-title">Color Palette</h2>
          <div class="d-flex gap-4 flex-wrap">
            <div v-for="(color, name) in stringColors" :key="name" class="color-box">
              <div class="color-preview" :style="{ backgroundColor: color }"></div>
              <p class="color-name mt-2">{{ name }}</p>
              <p class="color-value">{{ color }}</p>
            </div>
            <!-- Gradient Preview -->
            <div class="color-box">
              <div class="color-preview gradient-preview"></div>
              <p class="color-name mt-2">Brand Gradient</p>
              <p class="color-value">Primary → Accent</p>
            </div>
          </div>
        </div>

        <!-- Buttons Section -->
        <div class="section mb-8">
          <h2 class="section-title">Buttons</h2>
          <div class="d-flex gap-4 flex-wrap align-center">
            <v-btn class="primary-btn">Primary Button</v-btn>
            <v-btn class="gradient-btn">Gradient Button</v-btn>
            <v-btn class="secondary-btn">Secondary Button</v-btn>
            <v-btn class="outline-btn">Outline Button</v-btn>
            <v-btn class="text-btn">Text Button</v-btn>
          </div>
        </div>

        <!-- Typography Section -->
        <div class="section mb-8">
          <h2 class="section-title">Typography</h2>
          <div class="typography-showcase">
            <div class="font-sample poppins">
              <h3 class="font-title">Poppins - Headings</h3>
              <h1 class="heading-1">The quick brown fox</h1>
              <h2 class="heading-2">The quick brown fox</h2>
              <h3 class="heading-3">The quick brown fox</h3>
            </div>
            <div class="font-sample inter mt-8">
              <h3 class="font-title">Inter - Body Text</h3>
              <p class="body-text">The quick brown fox jumps over the lazy dog. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <p class="caption-text mt-2">Caption text - The quick brown fox jumps over the lazy dog.</p>
            </div>
          </div>
        </div>

        <!-- Links Section -->
        <div class="section mb-8">
          <h2 class="section-title">Interactive Elements</h2>
          <div class="d-flex gap-6 align-center">
            <a href="#" class="nav-link">Navigation Link</a>
            <a href="#" class="text-link">Animated Link</a>
            <div class="interactive-card">
              Hover Card
            </div>
          </div>
        </div>
      </div>
    </v-container>
  </AppLayout>
</template>

<style>
/* Global Font Imports */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap');

/* Global Font Settings */
:root {
  --font-heading: 'Poppins', sans-serif;
  --font-body: 'Inter', sans-serif;
}

/* Apply fonts globally */
body {
  font-family: var(--font-body);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

h1, h2, h3, h4, h5, h6 {
  font-family: var(--font-heading);
}
</style>

<style scoped>
/* Color Preview Boxes */
.color-box {
  width: 160px;
  background: v-bind('colors.white');
  padding: 12px;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.color-preview {
  width: 100%;
  height: 100px;
  border-radius: 8px;
}

.gradient-preview {
  background: linear-gradient(135deg, v-bind('colors.gradient.start'), v-bind('colors.gradient.end'));
}

.color-name {
  font-weight: 600;
  color: v-bind('colors.secondary');
  margin-bottom: 4px;
}

.color-value {
  color: v-bind('colors.grey');
  font-size: 0.875rem;
}

/* Buttons */
.primary-btn {
  background-color: v-bind('colors.primary') !important;
  color: v-bind('colors.white') !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  letter-spacing: 0.3px;
}

.primary-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
}

.gradient-btn {
  background: linear-gradient(135deg, v-bind('colors.gradient.start'), v-bind('colors.gradient.end')) !important;
  color: v-bind('colors.white') !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.gradient-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(124, 58, 237, 0.2);
}

.secondary-btn {
  background-color: v-bind('colors.secondary') !important;
  color: v-bind('colors.white') !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
  transition: all 0.3s ease;
}

.outline-btn {
  border: 2px solid v-bind('colors.primary') !important;
  color: v-bind('colors.primary') !important;
  background: transparent !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
  transition: all 0.3s ease;
}

.outline-btn:hover {
  background: rgba(37, 99, 235, 0.05) !important;
}

.text-btn {
  color: v-bind('colors.primary') !important;
  background: transparent !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
  transition: all 0.3s ease;
}

.text-btn:hover {
  background: rgba(37, 99, 235, 0.05) !important;
}

/* Typography Showcase */
.typography-showcase {
  padding: 2rem;
  background: white;
  border-radius: 12px;
}

.font-sample {
  padding: 1.5rem;
  border: 1px solid v-bind('colors.lightGrey');
  border-radius: 8px;
}

.font-title {
  font-size: 0.875rem;
  color: v-bind('colors.grey');
  margin-bottom: 1rem;
  font-weight: 500;
}

.poppins * {
  font-family: var(--font-heading);
}

.inter * {
  font-family: var(--font-body);
}

/* Typography */
.heading-1 {
  font-family: var(--font-heading);
  font-size: 3.5rem;
  font-weight: 700;
  color: v-bind('colors.secondary');
  line-height: 1.2;
  margin-bottom: 1.5rem;
  letter-spacing: -0.02em;
}

.heading-2 {
  font-family: var(--font-heading);
  font-size: 2.75rem;
  font-weight: 700;
  color: v-bind('colors.secondary');
  line-height: 1.2;
  margin-bottom: 1.25rem;
  letter-spacing: -0.01em;
}

.heading-3 {
  font-family: var(--font-heading);
  font-size: 2rem;
  font-weight: 600;
  color: v-bind('colors.secondary');
  line-height: 1.3;
  margin-bottom: 1rem;
}

.section-title {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  font-weight: 600;
  background: linear-gradient(135deg, v-bind('colors.gradient.start'), v-bind('colors.gradient.end'));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 2rem;
}

.body-text {
  font-family: var(--font-body);
  font-size: 1.125rem;
  line-height: 1.7;
  color: v-bind('colors.secondary');
  margin-bottom: 1.25rem;
}

.caption-text {
  font-family: var(--font-body);
  font-size: 0.875rem;
  color: v-bind('colors.grey');
  line-height: 1.5;
}

/* Links */
.nav-link {
  color: v-bind('colors.secondary');
  text-decoration: none;
  font-weight: 500;
  padding: 0.75rem 1.25rem;
  transition: all 0.3s ease;
  border-radius: 8px;
  background: v-bind('colors.lightGrey');
}

.nav-link:hover {
  color: v-bind('colors.primary');
  background: rgba(37, 99, 235, 0.1);
}

.text-link {
  color: v-bind('colors.primary');
  text-decoration: none;
  position: relative;
  font-weight: 500;
  padding: 0.25rem 0;
}

.text-link::after {
  content: '';
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background: linear-gradient(135deg, v-bind('colors.gradient.start'), v-bind('colors.gradient.end'));
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.3s ease;
}

.text-link:hover::after {
  transform: scaleX(1);
  transform-origin: left;
}

/* Interactive Card */
.interactive-card {
  padding: 1.5rem;
  background: v-bind('colors.white');
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
}

.interactive-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(37, 99, 235, 0.12);
}

/* Sections */
.section {
  padding: 2.5rem;
  background-color: v-bind('colors.white');
  border-radius: 16px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
}

/* Utility Classes */
.mb-8 {
  margin-bottom: 2.5rem;
}
</style>
