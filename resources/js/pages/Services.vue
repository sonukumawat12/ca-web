<script setup lang="ts">
import FrontEndLayout from '@/layouts/FrontEndLayput.vue';
import PageHero from '@/components/PageHero.vue';
import FooterSection from '@/components/FooterSection.vue';

const services = [
  {
    title: 'Tax Planning & Filing',
    icon: 'mdi-file-document-outline',
    description: 'Comprehensive tax planning and filing services for individuals and businesses.',
    features: [
      'Income Tax Return Filing',
      'Tax Planning & Strategy',
      'Tax Audit Support',
      'International Taxation',
      'Tax Compliance Review',
      'Tax Advisory Services'
    ],
    image: '/images/tax.jpg'
  },
  {
    title: 'GST Services',
    icon: 'mdi-cash-register',
    description: 'End-to-end GST solutions to ensure compliance and optimize your tax structure.',
    features: [
      'GST Registration',
      'GST Return Filing',
      'GST Compliance Audit',
      'GST Advisory',
      'Input Tax Credit Analysis',
      'GST Refund Processing'
    ],
    image: '/images/gst.jpg'
  },
  {
    title: 'Business Setup',
    icon: 'mdi-domain',
    description: 'Complete assistance in setting up and registering your business entity.',
    features: [
      'Company Registration',
      'LLP Formation',
      'MSME Registration',
      'Business Licenses',
      'Trademark Registration',
      'Business Advisory'
    ],
    image: '/images/business.jpg'
  },
  {
    title: 'Audit & Assurance',
    icon: 'mdi-clipboard-check',
    description: 'Comprehensive audit services to ensure financial transparency and compliance.',
    features: [
      'Statutory Audit',
      'Internal Audit',
      'Tax Audit',
      'Due Diligence',
      'Compliance Review',
      'Risk Assessment'
    ],
    image: '/images/audit.jpg'
  },
  {
    title: 'Financial Advisory',
    icon: 'mdi-chart-line',
    description: 'Strategic financial guidance to help your business grow and succeed.',
    features: [
      'Business Valuation',
      'Financial Planning',
      'Investment Advisory',
      'Merger & Acquisition',
      'Fund Raising',
      'Business Restructuring'
    ],
    image: '/images/finance.jpg'
  },
  {
    title: 'Compliance Services',
    icon: 'mdi-shield-check',
    description: 'Ensure your business stays compliant with all regulatory requirements.',
    features: [
      'ROC Compliance',
      'Secretarial Services',
      'Legal Compliance',
      'Regulatory Filings',
      'Compliance Monitoring',
      'Policy Development'
    ],
    image: '/images/compliance.jpg'
  }
];

const testimonials = [
  {
    name: 'Vikram Singh',
    company: 'Tech Solutions Ltd',
    text: 'Their tax planning services helped us save significantly on our tax liability. Highly recommended!',
    image: 'https://randomuser.me/api/portraits/men/41.jpg'
  },
  {
    name: 'Anita Desai',
    company: 'Global Imports',
    text: 'The GST compliance team is extremely professional and thorough. They made the process seamless.',
    image: 'https://randomuser.me/api/portraits/women/42.jpg'
  },
  {
    name: 'Rahul Mehta',
    company: 'Startup Innovators',
    text: 'Their business setup services were invaluable in getting our company off the ground quickly.',
    image: 'https://randomuser.me/api/portraits/men/43.jpg'
  }
];
</script>

<template>
  <FrontEndLayout>
    <PageHero
      title="Our Services"
      subtitle="Comprehensive financial solutions for your business success"
      badge="What We Offer"
      background-image="https://picsum.photos/seed/services/1920/1080"
    />

    <!-- Services Grid -->
    <section class="services-grid-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">What We Offer</span>
          <h2 class="section-title">Comprehensive Financial Services</h2>
          <p class="section-subtitle">Expert solutions for all your financial needs</p>
        </div>
        <v-row>
          <v-col v-for="service in services" :key="service.title" cols="12" md="6" lg="4">
            <div class="service-card">
              <div class="service-image-wrapper">
                <img :src="service.image" :alt="service.title" class="service-image">
                <div class="service-overlay">
                  <v-icon :icon="service.icon" size="48" class="service-icon"></v-icon>
                </div>
              </div>
              <div class="service-content">
                <h3 class="service-title">{{ service.title }}</h3>
                <p class="service-description">{{ service.description }}</p>
                <div class="service-features">
                  <div v-for="feature in service.features" :key="feature" class="service-feature">
                    <v-icon icon="mdi-check-circle" color="success" size="20"></v-icon>
                    <span>{{ feature }}</span>
                  </div>
                </div>
                <v-btn
                  class="service-btn"
                  variant="outlined"
                  color="primary"
                >
                  Learn More
                </v-btn>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- Process Section -->
    <section class="process-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">How We Work</span>
          <h2 class="section-title">Our Process</h2>
          <p class="section-subtitle">Simple and efficient service delivery</p>
        </div>
        <v-row class="process-steps">
          <v-col cols="12" md="3">
            <div class="process-step">
              <div class="process-number">01</div>
              <h3 class="process-title">Consultation</h3>
              <p class="process-description">Initial discussion to understand your requirements and objectives</p>
            </div>
          </v-col>
          <v-col cols="12" md="3">
            <div class="process-step">
              <div class="process-number">02</div>
              <h3 class="process-title">Analysis</h3>
              <p class="process-description">Detailed assessment of your current situation and needs</p>
            </div>
          </v-col>
          <v-col cols="12" md="3">
            <div class="process-step">
              <div class="process-number">03</div>
              <h3 class="process-title">Solution</h3>
              <p class="process-description">Development of customized solutions for your specific needs</p>
            </div>
          </v-col>
          <v-col cols="12" md="3">
            <div class="process-step">
              <div class="process-number">04</div>
              <h3 class="process-title">Implementation</h3>
              <p class="process-description">Efficient execution and ongoing support for your requirements</p>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">Testimonials</span>
          <h2 class="section-title">What Our Clients Say</h2>
        </div>
        <v-row>
          <v-col v-for="testimonial in testimonials" :key="testimonial.name" cols="12" md="4">
            <div class="testimonial-card">
              <div class="testimonial-content">
                <v-icon icon="mdi-format-quote-open" size="32" color="primary" class="quote-icon"></v-icon>
                <p class="testimonial-text">{{ testimonial.text }}</p>
              </div>
              <div class="testimonial-author">
                <v-avatar size="48">
                  <img :src="testimonial.image" :alt="testimonial.name">
                </v-avatar>
                <div class="testimonial-info">
                  <div class="testimonial-name">{{ testimonial.name }}</div>
                  <div class="testimonial-company">{{ testimonial.company }}</div>
                </div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- CTA Section -->
    <section class="services-cta-section">
      <div class="cta-background">
        <div class="cta-overlay"></div>
      </div>
      <v-container>
        <div class="cta-content">
          <h2 class="cta-title">Ready to Get Started?</h2>
          <p class="cta-subtitle">Let's discuss how we can help your business grow</p>
          <div class="cta-buttons">
            <v-btn
              size="x-large"
              class="primary-btn"
              elevation="0"
            >
              Schedule Consultation
            </v-btn>
            <v-btn
              size="x-large"
              variant="outlined"
              class="secondary-btn"
              elevation="0"
            >
              Contact Us
            </v-btn>
          </div>
        </div>
      </v-container>
    </section>

    <FooterSection />
  </FrontEndLayout>
</template>

<style>
/* Hero Section */
.services-hero {
  position: relative;
  height: 50vh;
  min-height: 400px;
  background: url('/images/services-hero.jpg') center/cover no-repeat;
  display: flex;
  align-items: center;
  color: white;
}

.services-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
}

.services-hero-content {
  position: relative;
  z-index: 1;
  max-width: 800px;
}

.services-hero-title {
  font-size: 56px;
  font-weight: 800;
  margin-bottom: 24px;
  line-height: 1.2;
}

.services-hero-subtitle {
  font-size: 20px;
  opacity: 0.9;
  max-width: 600px;
}

/* Services Grid Section */
.services-grid-section {
  padding: 96px 0;
  background: var(--background-light);
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
  max-width: 600px;
  margin: 0 auto;
}

.service-card {
  background: white;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: transform 0.3s ease;
  height: 100%;
}

.service-card:hover {
  transform: translateY(-5px);
}

.service-image-wrapper {
  position: relative;
  height: 200px;
  overflow: hidden;
}

.service-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.service-card:hover .service-image {
  transform: scale(1.05);
}

.service-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6));
  display: flex;
  align-items: center;
  justify-content: center;
}

.service-icon {
  color: white;
}

.service-content {
  padding: 32px;
}

.service-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 16px;
  color: var(--text-primary);
}

.service-description {
  font-size: 16px;
  color: var(--text-secondary);
  margin-bottom: 24px;
  line-height: 1.6;
}

.service-features {
  margin-bottom: 24px;
}

.service-feature {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
  color: var(--text-primary);
}

.service-btn {
  width: 100%;
}

/* Process Section */
.process-section {
  padding: 96px 0;
  background: white;
}

.process-steps {
  margin-top: 48px;
}

.process-step {
  text-align: center;
  padding: 32px;
  position: relative;
}

.process-number {
  font-size: 48px;
  font-weight: 800;
  color: var(--primary-color);
  opacity: 0.2;
  margin-bottom: 16px;
}

.process-title {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 12px;
  color: var(--text-primary);
}

.process-description {
  font-size: 16px;
  color: var(--text-secondary);
  line-height: 1.6;
}

/* Testimonials Section */
.testimonials-section {
  padding: 96px 0;
  background: var(--background-light);
}

.testimonial-card {
  background: white;
  border-radius: 24px;
  padding: 32px;
  height: 100%;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: transform 0.3s ease;
}

.testimonial-card:hover {
  transform: translateY(-5px);
}

.testimonial-content {
  margin-bottom: 24px;
}

.quote-icon {
  margin-bottom: 16px;
}

.testimonial-text {
  font-size: 18px;
  color: var(--text-primary);
  line-height: 1.6;
}

.testimonial-author {
  display: flex;
  align-items: center;
  gap: 16px;
}

.testimonial-info {
  flex: 1;
}

.testimonial-name {
  font-weight: 600;
  color: var(--text-primary);
}

.testimonial-company {
  font-size: 14px;
  color: var(--text-secondary);
}

/* CTA Section */
.services-cta-section {
  position: relative;
  padding: 96px 0;
  background: url('/images/handoff.jpeg') center/cover no-repeat;
  color: white;
  text-align: center;
}

.cta-background {
  position: absolute;
  inset: 0;
}

.cta-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
}

.cta-content {
  position: relative;
  z-index: 1;
  max-width: 800px;
  margin: 0 auto;
}

.cta-title {
  font-size: 48px;
  font-weight: 800;
  margin-bottom: 24px;
}

.cta-subtitle {
  font-size: 20px;
  opacity: 0.9;
  margin-bottom: 40px;
}

.cta-buttons {
  display: flex;
  gap: 24px;
  justify-content: center;
}

/* Responsive Design */
@media (max-width: 960px) {
  .services-hero-title {
    font-size: 40px;
  }

  .services-hero-subtitle {
    font-size: 18px;
  }

  .section-title {
    font-size: 32px;
  }

  .cta-title {
    font-size: 36px;
  }

  .cta-buttons {
    flex-direction: column;
    gap: 16px;
  }
}

@media (max-width: 600px) {
  .services-hero {
    height: 40vh;
  }

  .services-hero-title {
    font-size: 32px;
  }

  .service-content {
    padding: 24px;
  }

  .process-step {
    padding: 24px;
  }
}
</style>
