<script setup lang="ts">
import FrontEndLayout from '@/layouts/FrontEndLayput.vue';
import FooterSection from '@/components/FooterSection.vue';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const services = [
  {
    icon: 'bi bi-file-earmark-text',
    title: 'ITR Filing',
    desc: 'Quick & accurate income tax returns.'
  },
  {
    icon: 'bi bi-receipt',
    title: 'GST Registration',
    desc: 'Get your business GST ready in 48 hrs.'
  },
  {
    icon: 'bi bi-building',
    title: 'Company Setup',
    desc: 'Private Limited, LLP & MSME registration.'
  },
  {
    icon: 'bi bi-check2-circle',
    title: 'Audit & Compliance',
    desc: 'Yearly auditing & ROC compliance.'
  }
];

const aboutServices = [
  'Tax Consultancy and Planning',
  'GST and Income Tax Filing',
  'Financial Statement Preparation',
  'Audit and Assurance Services',
  'Business Valuation and Mergers',
  'Corporate Financial Consulting',
];

const reviews = [
  {
    name: 'Rahul Verma',
    role: 'Business Owner',
    avatar: 'https://randomuser.me/api/portraits/men/45.jpg',
    text: 'Very professional and quick service. Got my GST registration in just 2 days!'
  },
  {
    name: 'Sneha Patil',
    role: 'Freelancer',
    avatar: 'https://randomuser.me/api/portraits/women/65.jpg',
    text: 'They took care of my ITR without any hassle. Highly recommend them!'
  },
  {
    name: 'Amit Jain',
    role: 'Startup Founder',
    avatar: 'https://randomuser.me/api/portraits/men/51.jpg',
    text: 'Helped me with company incorporation and compliance from scratch.'
  }
];

const carouselRef = ref<HTMLElement | null>(null);
let intervalId: number | null = null;

const startCarousel = () => {
  const carousel = carouselRef.value;
  if (!carousel) return;
  intervalId = window.setInterval(() => {
    if (carousel.scrollLeft + carousel.offsetWidth >= carousel.scrollWidth) {
      carousel.scrollLeft = 0;
    } else {
      carousel.scrollLeft += 1;
    }
  }, 16); // ~60fps
};

const stopCarousel = () => {
  if (intervalId) {
    window.clearInterval(intervalId);
    intervalId = null;
  }
};

const servicesCarouselRef = ref<HTMLElement | null>(null);

function scrollServices(direction: number) {
  const el = servicesCarouselRef.value;
  if (!el) return;
  const card = el.querySelector('.horizontal-service-card') as HTMLElement;
  if (!card) return;
  const scrollAmount = card.offsetWidth + 24; // 1.5rem gap
  el.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}

const handleGetStarted = () => {
  window.location.href = '/contact';
};

onMounted(() => {
  startCarousel();
});

onBeforeUnmount(() => {
  stopCarousel();
});
</script>

<template>
  <FrontEndLayout>
    <!-- 1. Hero Section -->
    <section class="hero-section">
      <div class="hero-background">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
      </div>
      <v-container class="hero-container">
        <v-row align="center" class="fill-height">
          <v-col cols="12" md="6" class="hero-content">
            <div class="hero-badge">
              <span class="hero-badge-icon">✨</span>
              <span>Trusted CA Solutions</span>
            </div>
            <h1 class="hero-title">
              Expert <span class="gradient-text">CA Services</span> for Your Business Growth
            </h1>
            <p class="hero-subtitle">
              Tax, audit, and compliance made effortless. 15+ years of trusted expertise, tailored for your growth and peace of mind.
            </p>
            <div class="hero-cta">
              <v-btn
                size="x-large"
                class="primary-btn"
                elevation="0"
                @click="handleGetStarted"
              >
                Get Started
                <v-icon end icon="mdi-arrow-right" class="ml-2"></v-icon>
              </v-btn>
              <v-btn
                size="x-large"
                variant="outlined"
                class="secondary-btn"
                elevation="0"
              >
                <v-icon start icon="mdi-phone" class="mr-2"></v-icon>
                Schedule Call
              </v-btn>
            </div>
            <div class="hero-stats">
              <div class="stat-item">
                <div class="stat-value">99%</div>
                <div class="stat-label">Client Satisfaction</div>
            </div>
              <div class="stat-divider"></div>
              <div class="stat-item">
                <div class="stat-value">15+</div>
                <div class="stat-label">Years Experience</div>
          </div>
              <div class="stat-divider"></div>
              <div class="stat-item">
                <div class="stat-value">500+</div>
                <div class="stat-label">Happy Clients</div>
            </div>
          </div>
        </v-col>
          <v-col cols="12" md="6" class="hero-image-col">
            <div class="hero-image-wrapper">
              <img src="/images/ca.png" alt="CA Services" class="hero-image" />
              <div class="hero-image-decoration"></div>
          </div>
        </v-col>
      </v-row>
    </v-container>
    </section>

    <!-- 2. Services Section -->
    <section class="services-section horizontal-services-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">Our Services</span>
          <h2 class="section-title">Comprehensive CA Solutions</h2>
          <p class="section-subtitle">Expert financial services tailored to your business needs</p>
              </div>
        <div class="horizontal-services-carousel-wrapper">
          <button class="carousel-arrow left" @click="scrollServices(-1)">
            <v-icon icon="mdi-chevron-left" />
          </button>
          <div class="horizontal-services-carousel" ref="servicesCarouselRef">
            <div v-for="service in services" :key="service.title" class="horizontal-service-card">
              <div class="horizontal-service-icon-bg">
                <i :class="service.icon" class="horizontal-service-icon"></i>
            </div>
              <h3 class="horizontal-service-title">{{ service.title }}</h3>
              <p class="horizontal-service-desc">{{ service.desc }}</p>
                </div>
              </div>
          <button class="carousel-arrow right" @click="scrollServices(1)">
            <v-icon icon="mdi-chevron-right" />
          </button>
                </div>
      </v-container>
    </section>

    <!-- 3. About Section -->
    <section class="about-section">
      <v-container>
        <v-row align="center" class="about-row">
          <v-col cols="12" md="6" class="about-content">
            <span class="section-badge">About Us</span>
            <h2 class="section-title">Your Trusted Financial Partner</h2>
            <p class="about-description">
              We specialize in offering expert accounting, auditing, and tax services tailored to the unique needs of individuals and businesses. Our team of experienced Chartered Accountants ensures accuracy, compliance, and timely delivery of financial solutions.
            </p>
            <div class="about-features">
              <div v-for="item in aboutServices" :key="item" class="about-feature">
                <v-icon color="success" icon="mdi-check-circle" class="feature-icon"></v-icon>
                <span>{{ item }}</span>
              </div>
          </div>
            <div class="about-cta">
              <v-btn
                size="large"
                class="primary-btn"
                elevation="0"
              >
                Learn More About Us
              </v-btn>
            </div>
          </v-col>
          <v-col cols="12" md="6" class="about-image-col">
            <div class="about-image-wrapper">
              <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" alt="CA Team" class="about-image" />
              <div class="experience-badge">
                <div class="experience-years">15+</div>
                <div class="experience-text">Years of Excellence</div>
            </div>
          </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- 4. Reviews Section -->
    <section class="reviews-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">Testimonials</span>
          <h2 class="section-title">What Our Clients Say</h2>
          <p class="section-subtitle">Trusted by businesses across India</p>
        </div>
        <v-row class="reviews-grid">
          <v-col cols="12" md="4" v-for="review in reviews" :key="review.name">
            <div class="review-card">
              <div class="review-content">
                <div class="review-quote">"</div>
                <p class="review-text">{{ review.text }}</p>
              </div>
              <div class="review-author">
                <v-avatar size="48" class="review-avatar">
                  <img :src="review.avatar" :alt="review.name" />
                </v-avatar>
                <div class="review-info">
                  <div class="review-name">{{ review.name }}</div>
                  <div class="review-role">{{ review.role }}</div>
                </div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- 5. CTA Section -->
    <section class="cta-section">
      <div class="cta-background">
        <div class="cta-overlay"></div>
        <img src="/images/ofc.jpg" alt="Professional Office Team" class="cta-bg-image" />
      </div>
      <v-container>
        <div class="cta-content">
          <h2 class="cta-title">Ready to Transform Your Business?</h2>
          <p class="cta-subtitle">Let's discuss how we can help you achieve your financial goals</p>
          <div class="cta-buttons">
            <v-btn
              size="x-large"
              class="primary-btn"
              elevation="0"
              style="height: 54px;"
            >
              Get Started Now
            </v-btn>
            <v-btn
              size="x-large"
              variant="outlined"
              class="secondary-btn"
              elevation="0"

              style="height: 54px;"
            >
              Schedule a Call
            </v-btn>
          </div>
        </div>
      </v-container>
    </section>

    <!-- 6. Footer -->
    <FooterSection />
  </FrontEndLayout>
</template>

<style>
/* Base Styles */
:root {
  --primary-color: #2563EB;
  --secondary-color: #7C3AED;
  --text-primary: #1E293B;
  --text-secondary: #64748B;
  --background-light: #F8FAFC;
  --background-white: #FFFFFF;
  --success-color: #22C55E;
  --border-radius: 16px;
  --transition-speed: 0.3s;
}

/* Hero Section */
.hero-section {
  position: relative;
  padding: 0;
  min-height: 90vh;
  height: 90vh;
  max-height: 90vh;
  overflow: hidden;
  background: var(--background-light);
  display: flex;
  align-items: center;
}

.hero-background {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.hero-gradient {
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle at center, rgba(37,99,235,0.1) 0%, rgba(124,58,237,0.05) 50%, transparent 70%);
  animation: rotate 30s linear infinite;
}

.hero-pattern {
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232563EB' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  opacity: 0.5;
}

.hero-container {
  position: relative;
  z-index: 1;
  height: 100vh;
  display: flex;
  align-items: center;
}

.hero-content {
  padding-right: 32px;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  background: rgba(37,99,235,0.1);
  color: var(--primary-color);
  padding: 8px 16px;
  border-radius: 32px;
  font-weight: 600;
  margin-bottom: 24px;
}

.hero-badge-icon {
  margin-right: 8px;
}

.hero-title {
  font-size: 56px;
  font-weight: 800;
  line-height: 1.2;
  color: var(--text-primary);
  margin-bottom: 24px;
  }

.gradient-text {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero-subtitle {
  font-size: 20px;
  color: var(--text-secondary);
  margin-bottom: 32px;
  max-width: 512px;
  }

.hero-cta {
  display: flex;
  gap: 16px;
  margin-bottom: 48px;
  }

.primary-btn {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  color: white;
  font-weight: 600;
  border-radius: 32px;
  padding: 12px 32px;
  transition: transform var(--transition-speed), box-shadow var(--transition-speed);
}

.primary-btn:hover {
  transform: translateY(-0.125rem);
  box-shadow: 0 .25rem 1.25rem rgba(37,99,235,0.2);
}

.secondary-btn {
  border: .125rem solid var(--primary-color);
  color: var(--primary-color);
  font-weight: 600;
  border-radius: 32px;
  padding: 12px 32px;
  transition: all var(--transition-speed);
}

.secondary-btn:hover {
  background: var(--primary-color);
  color: white;
}

.hero-stats {
  display: flex;
  align-items: center;
  gap: 32px;
}

.stat-item {
  text-align: center;
}

.stat-value {
  font-size: 32px;
  font-weight: 700;
  color: var(--primary-color);
  line-height: 1;
}

.stat-label {
  font-size: 14px;
  color: var(--text-secondary);
  margin-top: 8px;
}

.stat-divider {
  width: .0625rem;
  height: 32px;
  background: rgba(37,99,235,0.2);
}

.hero-image-wrapper {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero-image {
  width: 100%;
  max-width: 26.25rem;
  max-height: 70vh;
  height: auto;
  border-radius: var(--border-radius);
  box-shadow: 0 1.25rem 2.5rem rgba(37,99,235,0.1);
  animation: float 6s ease-in-out infinite;
  object-fit: contain;
}

.hero-image-decoration {
  position: absolute;
  inset: -1.25rem;
  border: .125rem solid var(--primary-color);
  border-radius: calc(var(--border-radius) + 1.25rem);
  opacity: 0.1;
  animation: pulse 4s ease-in-out infinite;
}

/* Services Section */
.services-section {
  padding: 96px 0;
  background: var(--background-white);
}

.section-header {
  text-align: center;
  margin-bottom: 64px;
}

.section-badge {
  display: inline-block;
  background: rgba(37,99,235,0.1);
  color: var(--primary-color);
  padding: 8px 16px;
  border-radius: 32px;
  font-weight: 600;
  margin-bottom: 16px;
}

.section-title {
  font-size: 40px;
  font-weight: 800;
  color: var(--text-primary);
  margin-bottom: 16px;
  }

.section-subtitle {
  font-size: 18px;
  color: var(--text-secondary);
  max-width: 512px;
  margin: 0 auto;
  }

.services-grid {
  margin-top: 32px;
  }

.service-card {
  background: var(--background-white);
  border-radius: var(--border-radius);
  padding: 32px;
  height: 100%;
  transition: transform var(--transition-speed), box-shadow var(--transition-speed);
  border: .0625rem solid rgba(37,99,235,0.1);
  }

.service-card:hover {
  transform: translateY(-0.3125rem);
  box-shadow: 0 1.25rem 2.5rem rgba(37,99,235,0.1);
  }

.service-icon {
  width: 64px;
  height: 64px;
  background: linear-gradient(135deg, rgba(37,99,235,0.1), rgba(124,58,237,0.1));
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 24px;
  }

.service-icon i {
  font-size: 24px;
  color: var(--primary-color);
}

.service-title {
  font-size: 20px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 12px;
}

.service-description {
  color: var(--text-secondary);
  margin-bottom: 24px;
}

.service-link {
  color: var(--primary-color);
  font-weight: 600;
  padding: 0;
}

/* About Section */
.about-section {
  padding: 96px 0;
  background: var(--background-light);
}

.about-row {
  align-items: center;
}

.about-content {
  padding-right: 64px;
}

.about-description {
  font-size: 18px;
  color: var(--text-secondary);
  margin: 24px 0;
}

.about-features {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  margin: 32px 0;
}

.about-feature {
  display: flex;
  align-items: center;
  gap: 12px;
  color: var(--text-primary);
}

.feature-icon {
  color: var(--success-color);
}

.about-image-wrapper {
  position: relative;
  width: 100%;
  padding-top: 100%;
}

.about-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: var(--border-radius);
  box-shadow: 0 1.25rem 2.5rem rgba(37,99,235,0.1);
}

.experience-badge {
  position: absolute;
  bottom: -32px;
  right: -32px;
  background: var(--primary-color);
  color: white;
  padding: 24px;
  border-radius: var(--border-radius);
  text-align: center;
  box-shadow: 0 .625rem 1.875rem rgba(37,99,235,0.2);
}

.experience-years {
  font-size: 40px;
  font-weight: 800;
  line-height: 1;
  }

.experience-text {
  font-size: 14px;
  opacity: 0.9;
  }

/* Reviews Section */
.reviews-section {
  padding: 96px 0;
  background: var(--background-white);
}

.reviews-grid {
  margin-top: 32px;
  }

  .review-card {
  background: var(--background-white);
  border-radius: var(--border-radius);
  padding: 32px;
  height: 100%;
  transition: transform var(--transition-speed);
  border: .0625rem solid rgba(37,99,235,0.1);
}

.review-card:hover {
  transform: translateY(-0.3125rem);
}

.review-content {
  position: relative;
  margin-bottom: 32px;
}

.review-quote {
  font-size: 64px;
  color: var(--primary-color);
  opacity: 0.2;
  position: absolute;
  top: -16px;
  left: -16px;
  font-family: serif;
}

.review-text {
  font-size: 18px;
  color: var(--text-primary);
  line-height: 1.6;
  position: relative;
  z-index: 1;
}

.review-author {
  display: flex;
  align-items: center;
  gap: 16px;
}

.review-avatar {
  border: .125rem solid var(--primary-color);
}

.review-info {
  flex: 1;
}

.review-name {
  font-weight: 600;
  color: var(--text-primary);
}

.review-role {
  font-size: 14px;
  color: var(--text-secondary);
}

/* CTA Section */
.cta-section {
  position: relative;
  padding: 128px 0;
  color: white;
  text-align: center;
  overflow: hidden;
}

.cta-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
}

.cta-bg-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transform: scale(1.1);
  transition: transform 0.3s ease;
}

.cta-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  position:sticky;
    background: #000000db;
  z-index: 1;
}

.cta-content {
  position: relative;
  z-index: 2;
  max-width: 768px;
  margin: 0 auto;
}

.cta-title {
  font-size: 48px;
  font-weight: 800;
  margin-bottom: 24px;
  text-shadow: 0 .125rem .25rem rgba(0,0,0,0.1);
}

.cta-subtitle {
  font-size: 20px;
  opacity: 0.9;
  margin-bottom: 40px;
  text-shadow: 0 .0625rem .125rem rgba(0,0,0,0.1);
}

.cta-buttons {
  display: flex;
  gap: 24px;
  justify-content: center;
}

.cta-section .primary-btn {
  background: white;
  color: var(--primary-color);
  font-weight: 600;
  padding: 16px 40px;
}

.cta-section .primary-btn:hover {
  background: rgba(255,255,255,0.9);
  transform: translateY(-0.125rem);
  box-shadow: 0 .25rem 1.25rem rgba(0,0,0,0.2);
}

.cta-section .secondary-btn {
  border: .125rem solid white;
  color: white;
  font-weight: 600;
  padding: 16px 40px;
}

.cta-section .secondary-btn:hover {
  background: rgba(255,255,255,0.1);
  transform: translateY(-0.125rem);
}

@media (max-width: 60rem) {
  .cta-section {
    padding: 96px 0;
  }

  .cta-title {
    font-size: 40px;
  }

  .cta-buttons {
    flex-direction: column;
    gap: 16px;
  }
}

@media (max-width: 37.5rem) {
  .cta-section {
    padding: 64px 0;
  }

  .cta-title {
    font-size: 32px;
  }

  .cta-subtitle {
    font-size: 18px;
  }
}

/* Animations */
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-1.25rem); }
}

@keyframes pulse {
  0%, 100% { transform: scale(1); opacity: 0.1; }
  50% { transform: scale(1.05); opacity: 0.2; }
}

@keyframes rotate {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 60rem) {
  .hero-section {
    min-height: 70vh;
    height: auto;
    max-height: none;
    padding: 32px 0;
}
  .hero-container {
    height: auto;
    min-height: 70vh;
    align-items: flex-start;
}
  .hero-image {
    max-width: 20rem;
    max-height: 40vh;
  }
  .hero-title {
    font-size: 40px;
  }

  .hero-content {
    padding-right: 0;
    margin-bottom: 48px;
  }

  .about-content {
    padding-right: 0;
    margin-bottom: 48px;
  }

  .about-features {
    grid-template-columns: 1fr;
  }

  .cta-buttons {
  flex-direction: column;
  }
}

@media (max-width: 37.5rem) {
  .hero-section {
    min-height: 60vh;
    height: auto;
    padding: 16px 0;
  }
  .hero-container {
    min-height: 60vh;
    height: auto;
    align-items: flex-start;
  }
  .hero-image {
    max-width: 12.5rem;
    max-height: 30vh;
  }
  .hero-title {
    font-size: 32px;
}

  .hero-stats {
    flex-direction: column;
    gap: 16px;
}

  .stat-divider {
  display: none;
}

  .section-title {
  font-size: 32px;
  }
}

/* Horizontal Services Section (Carousel) */
.horizontal-services-section {
  background: var(--background-light);
  padding: 96px 0 96px 0;
}
.horizontal-services-carousel-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  margin-top: 48px;
}
.horizontal-services-carousel {
  display: flex;
  gap: 24px;
  overflow-x: auto;
  scroll-behavior: smooth;
  padding: .9375rem 0rem;
  scrollbar-width: none;
  -ms-overflow-style: none;
  width: 100%;
}
.horizontal-services-carousel::-webkit-scrollbar {
  display: none;
}
.horizontal-service-card {
  min-width: 16.25rem;
  max-width: 20rem;
  background: rgba(255,255,255,0.55);
  border-radius: 24px;
  box-shadow: 0 .5rem 2rem 0 rgba(31,38,135,0.10);
  backdrop-filter: blur(1rem);
  border: .0938rem solid rgba(124,58,237,0.10);
  padding: 35.2px 32px 32px 32px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: box-shadow 0.3s, transform 0.3s, border 0.3s;
  overflow: hidden;
  position: relative;
  flex: 0 0 auto;
}
.horizontal-service-card:hover {
  box-shadow: 0 1rem 3rem 0 rgba(124,58,237,0.13);
  transform: translateY(-0.5rem) scale(1.03);
  border: .0938rem solid var(--secondary-color);
}
.horizontal-service-icon-bg {
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
  background: linear-gradient(135deg, #e0e7ff 60%, #ede9fe 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 24px;
  box-shadow: 0 .125rem .75rem rgba(124,58,237,0.08);
  position: relative;
  z-index: 2;
  transition: background 0.3s;
}
.horizontal-service-card:hover .horizontal-service-icon-bg {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
}
.horizontal-service-icon {
  font-size: 32px;
  color: var(--secondary-color);
  transition: color 0.3s;
}
.horizontal-service-card:hover .horizontal-service-icon {
  color: #fff;
}
.horizontal-service-title {
  font-size: 20px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 8px;
  letter-spacing: -0.01em;
}
.horizontal-service-desc {
  color: var(--text-secondary);
  font-size: 16.8px;
  margin-bottom: 0;
  opacity: 0.92;
}
.carousel-arrow {
  background: rgba(255,255,255,0.85);
  border: none;
  border-radius: 50%;
  width: 2.75rem;
  height: 2.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 .125rem .75rem rgba(124,58,237,0.10);
  cursor: pointer;
  margin: 0 8px;
  font-size: 24px;
  transition: background 0.2s, box-shadow 0.2s;
  z-index: 10;
}
.carousel-arrow:hover {
  background: var(--secondary-color);
  color: #fff;
  box-shadow: 0 .25rem 1rem rgba(124,58,237,0.18);
}
.carousel-arrow.left {
  order: 0;
}
.carousel-arrow.right {
  order: 2;
}
@media (max-width: 56.25rem) {
  .horizontal-services-carousel-wrapper {
    margin-top: 32px;
  }
  .horizontal-service-card {
    min-width: 13.75rem;
    max-width: 16.25rem;
    padding: 19.2px 16px 16px 16px;
  }
  .horizontal-service-icon-bg {
    width: 3rem;
    height: 3rem;
    margin-bottom: 16px;
  }
  .horizontal-service-icon {
    font-size: 20.8px;
  }
}
@media (max-width: 37.5rem) {
  .horizontal-services-section {
    padding: 48px 0 48px 0;
  }
  .carousel-arrow {
    display: none;
  }
}
</style>

<style scoped>
@keyframes float {
  0% { transform: translateY(0px);}
  50% { transform: translateY(-19.2px);}
  100% { transform: translateY(0px);}
}
</style>
