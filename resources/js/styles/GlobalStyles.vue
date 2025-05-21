<script setup lang="ts">
// Color scheme constants
const colors = {
  primary: '#fc4623',      // Orange - Primary brand color
  secondary: '#2A3342',    // Dark blue-grey - Text and headings
  accent: '#4318FF',       // Purple - Accent color
  success: '#00C853',      // Green - Success states
  warning: '#FFB300',      // Amber - Warning states
  error: '#D32F2F',        // Red - Error states
  grey: '#64748B',         // Grey - Secondary text
  lightGrey: '#F8FAFC',    // Light grey - Background
  white: '#FFFFFF'         // White - Text on dark backgrounds
}
</script>

<template>
  <div class="style-guide">
    <!-- Example usage of styles -->
    <h2 class="section-title">Style Guide</h2>

    <!-- Buttons Section -->
    <div class="section mb-8">
      <h3 class="subsection-title">Buttons</h3>
      <div class="d-flex gap-4 flex-wrap">
        <v-btn class="primary-btn">Primary Button</v-btn>
        <v-btn class="secondary-btn">Secondary Button</v-btn>
        <v-btn class="outline-btn">Outline Button</v-btn>
        <v-btn class="text-btn">Text Button</v-btn>
      </div>
    </div>

    <!-- Typography Section -->
    <div class="section mb-8">
      <h3 class="subsection-title">Typography</h3>
      <h1 class="heading-1">Heading 1</h1>
      <h2 class="heading-2">Heading 2</h2>
      <h3 class="heading-3">Heading 3</h3>
      <p class="body-text">Body Text</p>
      <p class="caption-text">Caption Text</p>
    </div>

    <!-- Links Section -->
    <div class="section mb-8">
      <h3 class="subsection-title">Links</h3>
      <a href="#" class="nav-link">Navigation Link</a>
      <a href="#" class="text-link">Text Link</a>
    </div>
  </div>
</template>

<style scoped>
/* Buttons */
.primary-btn {
  background-color: v-bind('colors.primary') !important;
  color: v-bind('colors.white') !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
  transition: all 0.3s ease;
}

.primary-btn:hover {
  opacity: 0.9;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(252, 70, 35, 0.3);
}

.secondary-btn {
  background-color: v-bind('colors.secondary') !important;
  color: v-bind('colors.white') !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
}

.outline-btn {
  border: 2px solid v-bind('colors.primary') !important;
  color: v-bind('colors.primary') !important;
  background: transparent !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
}

.text-btn {
  color: v-bind('colors.primary') !important;
  background: transparent !important;
  text-transform: capitalize;
  font-weight: 500;
  padding: 0 24px;
  height: 48px;
}

/* Typography */
.heading-1 {
  font-size: 3rem;
  font-weight: 700;
  color: v-bind('colors.secondary');
  line-height: 1.2;
  margin-bottom: 1rem;
}

.heading-2 {
  font-size: 2.5rem;
  font-weight: 700;
  color: v-bind('colors.secondary');
  line-height: 1.2;
  margin-bottom: 1rem;
}

.heading-3 {
  font-size: 2rem;
  font-weight: 600;
  color: v-bind('colors.secondary');
  line-height: 1.2;
  margin-bottom: 1rem;
}

.section-title {
  font-size: 1.75rem;
  font-weight: 600;
  color: v-bind('colors.primary');
  margin-bottom: 2rem;
}

.subsection-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: v-bind('colors.grey');
  margin-bottom: 1rem;
}

.body-text {
  font-size: 1rem;
  line-height: 1.6;
  color: v-bind('colors.secondary');
  margin-bottom: 1rem;
}

.caption-text {
  font-size: 0.875rem;
  color: v-bind('colors.grey');
  line-height: 1.4;
}

/* Links */
.nav-link {
  color: v-bind('colors.secondary');
  text-decoration: none;
  font-weight: 500;
  padding: 0.5rem 1rem;
  transition: all 0.3s ease;
  border-radius: 4px;
}

.nav-link:hover {
  color: v-bind('colors.primary');
  background-color: rgba(252, 70, 35, 0.1);
}

.text-link {
  color: v-bind('colors.primary');
  text-decoration: none;
  position: relative;
}

.text-link::after {
  content: '';
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: -2px;
  left: 0;
  background-color: v-bind('colors.primary');
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.3s ease;
}

.text-link:hover::after {
  transform: scaleX(1);
  transform-origin: left;
}

/* Sections */
.section {
  padding: 2rem;
  background-color: v-bind('colors.white');
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
}

/* Utility Classes */
.mb-8 {
  margin-bottom: 2rem;
}
</style>
