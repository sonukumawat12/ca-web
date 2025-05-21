<script setup lang="ts">
import FrontEndLayout from '@/layouts/FrontEndLayput.vue';
import PageHero from '@/components/PageHero.vue';
import FooterSection from '@/components/FooterSection.vue';
import { ref, onMounted } from 'vue';

const formData = ref({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: ''
});

const offices = [
  {
    city: 'Mumbai',
    address: '123 Business Park, Andheri East, Mumbai - 400093',
    phone: '+91 22 1234 5678',
    email: 'mumbai@cafirm.com',
    hours: 'Mon - Fri: 9:00 AM - 6:00 PM',
    image: 'https://picsum.photos/seed/mumbai/800/600'
  },
  {
    city: 'Delhi',
    address: '45 Corporate Plaza, Connaught Place, New Delhi - 110001',
    phone: '+91 11 2345 6789',
    email: 'delhi@cafirm.com',
    hours: 'Mon - Fri: 9:00 AM - 6:00 PM',
    image: 'https://picsum.photos/seed/delhi/800/600'
  },
  {
    city: 'Bangalore',
    address: '78 Tech Park, Koramangala, Bangalore - 560034',
    phone: '+91 80 3456 7890',
    email: 'bangalore@cafirm.com',
    hours: 'Mon - Fri: 9:00 AM - 6:00 PM',
    image: 'https://picsum.photos/seed/bangalore/800/600'
  }
];

const contactInfo = [
  {
    icon: 'mdi-phone',
    title: 'Phone',
    content: '+91 1234567890',
    subtitle: 'Mon-Fri 9:00 AM - 6:00 PM'
  },
  {
    icon: 'mdi-email',
    title: 'Email',
    content: 'info@cafirm.com',
    subtitle: 'We\'ll respond within 24 hours'
  },
  {
    icon: 'mdi-clock',
    title: 'Working Hours',
    content: 'Monday - Friday',
    subtitle: '9:00 AM - 6:00 PM IST'
  }
];

const isSubmitting = ref(false);

const handleSubmit = async () => {
  isSubmitting.value = true;
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 2000));
    console.log('Form submitted:', formData.value);
    // Reset form
    formData.value = {
      name: '',
      email: '',
      phone: '',
      subject: '',
      message: ''
    };
  } finally {
    isSubmitting.value = false;
  }
};

// Animation observer setup
const observerOptions = {
  root: null,
  rootMargin: '0px',
  threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-in');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

onMounted(() => {
  // Observe all animated elements
  document.querySelectorAll('.animate-on-scroll').forEach((el) => {
    observer.observe(el);
  });
});
</script>

<template>
  <FrontEndLayout>
    <PageHero
      title="Contact Us"
      subtitle="Get in touch with our team of experts"
      badge="Let's Connect"
      background-image="https://picsum.photos/seed/contact/1920/1080"
    />

    <!-- Contact Info Section -->
    <section class="contact-info-section">
      <v-container>
        <div class="contact-info-grid">
          <div v-for="info in contactInfo" :key="info.title" class="contact-info-card">
            <div class="contact-info-icon">
              <v-icon :icon="info.icon" size="32"></v-icon>
            </div>
            <div class="contact-info-content">
              <h3 class="contact-info-title">{{ info.title }}</h3>
              <p class="contact-info-text">{{ info.content }}</p>
              <p class="contact-info-subtitle">{{ info.subtitle }}</p>
            </div>
          </div>
        </div>
      </v-container>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form-section">
      <v-container>
        <div class="contact-form-container">
          <div class="contact-form-content">
            <h2 class="contact-form-title">Send us a Message</h2>
            <p class="contact-form-subtitle">
              Fill out the form below and we'll get back to you as soon as possible
            </p>
            <form @submit.prevent="handleSubmit" class="contact-form">
              <div class="form-grid">
                <div class="form-group">
                  <label for="name">Full Name</label>
                  <v-text-field
                    v-model="formData.name"
                    id="name"
                    variant="outlined"
                    density="comfortable"
                    hide-details
                    required
                  ></v-text-field>
                </div>
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <v-text-field
                    v-model="formData.email"
                    id="email"
                    type="email"
                    variant="outlined"
                    density="comfortable"
                    hide-details
                    required
                  ></v-text-field>
                </div>
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <v-text-field
                    v-model="formData.phone"
                    id="phone"
                    type="tel"
                    variant="outlined"
                    density="comfortable"
                    hide-details
                    required
                  ></v-text-field>
                </div>
                <div class="form-group">
                  <label for="subject">Subject</label>
                  <v-text-field
                    v-model="formData.subject"
                    id="subject"
                    variant="outlined"
                    density="comfortable"
                    hide-details
                    required
                  ></v-text-field>
                </div>
              </div>
              <div class="form-group full-width">
                <label for="message">Message</label>
                <v-textarea
                  v-model="formData.message"
                  id="message"
                  variant="outlined"
                  rows="4"
                  hide-details
                  required
                ></v-textarea>
              </div>
              <div class="form-actions">
                <v-btn
                  type="submit"
                  size="x-large"
                  class="submit-btn"
                  elevation="0"
                >
                  <span class="btn-content">
                    <span class="btn-text">Send Message</span>
                    <v-icon icon="mdi-send" class="btn-icon"></v-icon>
                  </span>
                  <span class="btn-loader">
                    <v-progress-circular
                      indeterminate
                      color="white"
                      size="24"
                      width="2"
                    ></v-progress-circular>
                  </span>
                </v-btn>
              </div>
            </form>
          </div>
          <div class="contact-form-image">
            <img src="https://picsum.photos/seed/contact/800/1000" alt="Contact Us" />
          </div>
        </div>
      </v-container>
    </section>

    <!-- Offices Section -->
    <section class="offices-section">
      <v-container>
        <div class="section-header animate-on-scroll">
          <h2 class="section-title">Our Offices</h2>
          <p class="section-subtitle">Visit us at any of our locations across India</p>
        </div>
        <v-row>
          <v-col v-for="(office, index) in offices" :key="office.city" cols="12" md="4">
            <div class="office-card animate-on-scroll" :style="{ '--animation-delay': `${index * 0.2}s` }">
              <div class="office-image-wrapper">
                <img :src="office.image" :alt="office.city" class="office-image">
              </div>
              <div class="office-content">
                <h3 class="office-city">{{ office.city }}</h3>
                <div class="office-details">
                  <p class="office-address">
                    <v-icon icon="mdi-map-marker" size="20" class="mr-2"></v-icon>
                    {{ office.address }}
                  </p>
                  <p class="office-phone">
                    <v-icon icon="mdi-phone" size="20" class="mr-2"></v-icon>
                    {{ office.phone }}
                  </p>
                  <p class="office-email">
                    <v-icon icon="mdi-email" size="20" class="mr-2"></v-icon>
                    {{ office.email }}
                  </p>
                  <p class="office-hours">
                    <v-icon icon="mdi-clock-outline" size="20" class="mr-2"></v-icon>
                    {{ office.hours }}
                  </p>
                </div>
                <v-btn
                  variant="outlined"
                  color="primary"
                  class="office-btn"
                  :href="`https://maps.google.com/?q=${office.address}`"
                  target="_blank"
                >
                  Get Directions
                </v-btn>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <FooterSection />
  </FrontEndLayout>
</template>

<style>
/* Hero Section */
.contact-hero {
  position: relative;
  height: 50vh;
  min-height: 400px;
  background: url('https://picsum.photos/seed/contact-hero/1920/1080') center/cover no-repeat;
  display: flex;
  align-items: center;
  color: white;
}

.contact-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
}

.contact-hero-content {
  position: relative;
  z-index: 1;
  max-width: 800px;
}

.contact-hero-title {
  font-size: 56px;
  font-weight: 800;
  margin-bottom: 24px;
  line-height: 1.2;
}

.contact-hero-subtitle {
  font-size: 20px;
  opacity: 0.9;
  max-width: 600px;
}

/* Contact Info Section */
.contact-info-section {
  padding: 80px 0;
  background: var(--background-light);
}

.contact-info-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

.contact-info-card {
  background: white;
  border-radius: 24px;
  padding: 32px;
  display: flex;
  align-items: flex-start;
  gap: 24px;
  transition: all 0.3s ease;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.contact-info-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.contact-info-icon {
  width: 64px;
  height: 64px;
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
}

.contact-info-content {
  flex-grow: 1;
}

.contact-info-title {
  font-size: 20px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 8px;
}

.contact-info-text {
  font-size: 18px;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.contact-info-subtitle {
  font-size: 14px;
  color: var(--text-secondary);
}

/* Contact Form Section */
.contact-form-section {
  padding: 80px 0;
  background: white;
}

.contact-form-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 64px;
  align-items: center;
}

.contact-form-content {
  max-width: 600px;
}

.contact-form-title {
  font-size: 40px;
  font-weight: 800;
  color: var(--text-primary);
  margin-bottom: 16px;
}

.contact-form-subtitle {
  font-size: 18px;
  color: var(--text-secondary);
  margin-bottom: 40px;
}

.contact-form {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 24px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-group.full-width {
  grid-column: 1 / -1;
}

.form-group label {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-primary);
}

.form-actions {
  margin-top: 24px;
  display: flex;
  justify-content: center;
}

.submit-btn {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  color: white;
  font-weight: 600;
  border-radius: 32px;
  padding: 16px 48px;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  min-width: 200px;
}

.submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  opacity: 0;
  transition: opacity 0.3s ease;
}

.submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(37,99,235,0.2);
}

.submit-btn:hover::before {
  opacity: 1;
}

.btn-content {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  transition: transform 0.3s ease;
}

.btn-text {
  font-size: 16px;
  letter-spacing: 0.5px;
}

.btn-icon {
  transition: transform 0.3s ease;
}

.submit-btn:hover .btn-icon {
  transform: translateX(4px);
}

.btn-loader {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.submit-btn.loading .btn-content {
  opacity: 0;
}

.submit-btn.loading .btn-loader {
  opacity: 1;
}

/* Add ripple effect */
.submit-btn::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 5px;
  height: 5px;
  background: rgba(255, 255, 255, 0.5);
  opacity: 0;
  border-radius: 100%;
  transform: scale(1, 1) translate(-50%);
  transform-origin: 50% 50%;
}

.submit-btn:focus:not(:active)::after {
  animation: ripple 1s ease-out;
}

@keyframes ripple {
  0% {
    transform: scale(0, 0);
    opacity: 0.5;
  }
  100% {
    transform: scale(100, 100);
    opacity: 0;
  }
}

.contact-form-image {
  position: relative;
  height: 100%;
  min-height: 600px;
  border-radius: 24px;
  overflow: hidden;
}

.contact-form-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 24px;
  transition: transform 0.3s ease;
}

.contact-form-image:hover img {
  transform: scale(1.05);
}

/* Offices Section */
.offices-section {
  padding: 96px 0;
  background: var(--background-light);
}

.section-header {
  text-align: center;
  margin-bottom: 64px;
}

.office-card {
  background: white;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: transform 0.3s ease;
  height: 100%;
}

.office-card:hover {
  transform: translateY(-5px);
}

.office-image-wrapper {
  height: 200px;
  overflow: hidden;
}

.office-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.office-card:hover .office-image {
  transform: scale(1.05);
}

.office-content {
  padding: 32px;
}

.office-city {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 16px;
  color: var(--text-primary);
}

.office-details {
  margin-bottom: 24px;
}

.office-details p {
  display: flex;
  align-items: center;
  margin-bottom: 12px;
  color: var(--text-secondary);
}

.office-btn {
  width: 100%;
}

/* Responsive Design */
@media (max-width: 1200px) {
  .contact-info-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 960px) {
  .contact-hero-title {
    font-size: 40px;
  }

  .contact-form-container {
    grid-template-columns: 1fr;
  }

  .contact-form-image {
    display: none;
  }

  .contact-form-content {
    max-width: 100%;
  }
}

@media (max-width: 600px) {
  .contact-hero {
    height: 40vh;
  }

  .contact-hero-title {
    font-size: 32px;
  }

  .contact-info-grid {
    grid-template-columns: 1fr;
  }

  .form-grid {
    grid-template-columns: 1fr;
  }

  .contact-form-title {
    font-size: 32px;
  }
}
</style>
