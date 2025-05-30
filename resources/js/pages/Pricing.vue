<script setup lang="ts">
import FrontEndLayout from '@/layouts/FrontEndLayput.vue';
import PageHero from '@/components/PageHero.vue';
import FooterSection from '@/components/FooterSection.vue';
import { ref } from 'vue';

const pricingPlans = [
  {
    name: 'Basic',
    price: '₹4,999',
    period: 'per month',
    description: 'Perfect for small businesses and startups',
    features: [
      { text: 'Income Tax Filing', included: true },
      { text: 'GST Registration', included: true },
      { text: 'Basic Bookkeeping', included: true },
      { text: 'Monthly Compliance', included: true },
      { text: 'Email Support', included: true },
      { text: 'Basic Financial Reports', included: true },
      { text: 'GST Return Filing', included: false },
      { text: 'Advanced Bookkeeping', included: false },
      { text: 'Priority Support', included: false },
      { text: 'Financial Planning', included: false }
    ],
    icon: 'mdi-rocket-launch',
    popular: false,
    color: '#4F46E5'
  },
  {
    name: 'Professional',
    price: '₹9,999',
    period: 'per month',
    description: 'Ideal for growing businesses',
    features: [
      { text: 'Income Tax Filing', included: true },
      { text: 'GST Registration', included: true },
      { text: 'Basic Bookkeeping', included: true },
      { text: 'Monthly Compliance', included: true },
      { text: 'Email Support', included: true },
      { text: 'Basic Financial Reports', included: true },
      { text: 'GST Return Filing', included: true },
      { text: 'Advanced Bookkeeping', included: true },
      { text: 'Priority Support', included: true },
      { text: 'Financial Planning', included: true }
    ],
    icon: 'mdi-star',
    popular: true,
    color: '#2563EB'
  },
  {
    name: 'Enterprise',
    price: '₹19,999',
    period: 'per month',
    description: 'For established businesses',
    features: [
      { text: 'Income Tax Filing', included: true },
      { text: 'GST Registration', included: true },
      { text: 'Basic Bookkeeping', included: true },
      { text: 'Monthly Compliance', included: true },
      { text: 'Email Support', included: true },
      { text: 'Basic Financial Reports', included: true },
      { text: 'GST Return Filing', included: true },
      { text: 'Advanced Bookkeeping', included: true },
      { text: 'Priority Support', included: true },
      { text: 'Financial Planning', included: true },
      { text: 'Statutory Audit', included: true },
      { text: 'Internal Audit', included: true },
      { text: 'Due Diligence', included: true },
      { text: '24/7 Support', included: true },
      { text: 'Strategic Planning', included: true }
    ],
    icon: 'mdi-crown',
    popular: false,
    color: '#7C3AED'
  }
];

const faqs = [
  {
    question: 'What payment methods do you accept?',
    answer: 'We accept all major credit cards, net banking, UPI, and bank transfers. All payments are secure and encrypted.',
    icon: 'mdi-credit-card'
  },
  {
    question: 'Can I change my plan later?',
    answer: 'Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.',
    icon: 'mdi-swap-horizontal'
  },
  {
    question: 'Is there a setup fee?',
    answer: 'No, there are no setup fees. You only pay the monthly subscription fee for your chosen plan.',
    icon: 'mdi-cash'
  },
  {
    question: 'Do you offer custom pricing?',
    answer: 'Yes, we offer custom pricing for businesses with specific requirements. Contact our sales team for more information.',
    icon: 'mdi-tune'
  },
  {
    question: 'What kind of support do you provide?',
    answer: 'We provide comprehensive support through email, phone, and live chat. Our response time varies based on your plan, with priority support for Professional and Enterprise plans.',
    icon: 'mdi-headset'
  },
  {
    question: 'Can I cancel my subscription anytime?',
    answer: 'Yes, you can cancel your subscription at any time. We offer a 30-day money-back guarantee for all new subscriptions.',
    icon: 'mdi-close-circle'
  }
];

const expandedFaq = ref<number | null>(null);

const toggleFaq = (index: number) => {
  expandedFaq.value = expandedFaq.value === index ? null : index;
};
</script>

<template>
  <FrontEndLayout>
    <PageHero
      title="Our Pricing"
      subtitle="Transparent and competitive pricing for all your financial needs"
      badge="Investment Plans"
      background-image="https://picsum.photos/seed/pricing/1920/1080"
    />

    <!-- Pricing Plans Section -->
    <section class="pricing-plans-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">Pricing Plans</span>
          <h2 class="section-title">Choose Your Plan</h2>
          <p class="section-subtitle">Flexible options to suit your business needs</p>
        </div>
        <div class="pricing-cards-container">
          <div
            v-for="plan in pricingPlans" 
            :key="plan.name"
            class="pricing-card"
            :class="{ 'popular': plan.popular }"
            :style="{ '--plan-color': plan.color }"
          >
            <div v-if="plan.popular" class="popular-badge">Most Popular</div>
            <div class="pricing-header">
              <div class="plan-icon-wrapper">
                <v-icon :icon="plan.icon" size="48" class="plan-icon"></v-icon>
              </div>
              <h3 class="plan-name">{{ plan.name }}</h3>
              <div class="plan-price">
                <span class="price">{{ plan.price }}</span>
                <span class="period">{{ plan.period }}</span>
              </div>
              <p class="plan-description">{{ plan.description }}</p>
            </div>
            <div class="pricing-features">
              <div
                v-for="feature in plan.features"
                :key="feature.text"
                class="feature-item"
                :class="{ 'included': feature.included }"
              >
                <v-icon
                  :icon="feature.included ? 'mdi-check-circle' : 'mdi-close-circle'"
                  :color="feature.included ? 'success' : 'grey'"
                  size="20"
                ></v-icon>
                <span>{{ feature.text }}</span>
              </div>
            </div>
            <div class="pricing-footer">
              <v-btn
                :color="plan.popular ? 'primary' : 'outlined'"
                size="x-large"
                block
                class="plan-btn"
                :style="{ '--btn-color': plan.color }"
              >
                Get Started
                <v-icon icon="mdi-arrow-right" class="ml-2"></v-icon>
              </v-btn>
            </div>
          </div>
        </div>
      </v-container>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">FAQ</span>
          <h2 class="section-title">Frequently Asked Questions</h2>
          <p class="section-subtitle">Everything you need to know about our pricing</p>
        </div>
        <div class="faq-container">
          <div
            v-for="(faq, index) in faqs"
            :key="index"
            class="faq-item"
            :class="{ 'expanded': expandedFaq === index }"
            @click="toggleFaq(index)"
          >
            <div class="faq-question-wrapper">
              <div class="faq-icon">
                <v-icon :icon="faq.icon" color="primary"></v-icon>
              </div>
              <h3 class="faq-question">{{ faq.question }}</h3>
              <v-icon
                :icon="expandedFaq === index ? 'mdi-chevron-up' : 'mdi-chevron-down'"
                class="faq-arrow"
                :class="{ 'rotated': expandedFaq === index }"
              ></v-icon>
            </div>
            <div class="faq-answer-wrapper" :class="{ 'expanded': expandedFaq === index }">
              <p class="faq-answer">{{ faq.answer }}</p>
            </div>
          </div>
        </div>
      </v-container>
    </section>

    <!-- CTA Section -->
    <section class="pricing-cta-section">
      <div class="cta-background">
        <div class="cta-overlay"></div>
      </div>
      <v-container>
        <div class="cta-content">
          <h2 class="cta-title">Need a Custom Solution?</h2>
          <p class="cta-subtitle">Contact us for a personalized quote tailored to your business needs</p>
          <div class="cta-buttons">
            <v-btn
              size="x-large"
              class="primary-btn"
              elevation="0"
            >
              Contact Sales
            </v-btn>
            <v-btn
              size="x-large"
              variant="outlined"
              class="secondary-btn"
              elevation="0"
            >
              Schedule Call
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
.pricing-hero {
  position: relative;
  height: 50vh;
  min-height: 400px;
  background: url('/images/pricing-hero.jpg') center/cover no-repeat;
  display: flex;
  align-items: center;
  color: white;
}

.pricing-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
}

.pricing-hero-content {
  position: relative;
  z-index: 1;
  max-width: 800px;
}

.pricing-hero-title {
  font-size: 56px;
  font-weight: 800;
  margin-bottom: 24px;
  line-height: 1.2;
}

.pricing-hero-subtitle {
  font-size: 20px;
  opacity: 0.9;
  max-width: 600px;
}

/* Pricing Plans Section */
.pricing-plans-section {
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

.pricing-cards-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
  margin-top: 48px;
}

.pricing-card {
  background: white;
  border-radius: 24px;
  padding: 48px 32px;
  height: 100%;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  border: 2px solid transparent;
}

.pricing-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.pricing-card.popular {
  border-color: var(--plan-color);
  transform: scale(1.05);
}

.pricing-card.popular:hover {
  transform: scale(1.05) translateY(-5px);
}

.popular-badge {
  position: absolute;
  top: 16px;
  right: -35px;
  background: var(--plan-color);
  color: white;
  padding: 8px 40px;
  transform: rotate(45deg);
  font-size: 14px;
  font-weight: 600;
  z-index: 1;
}

.pricing-header {
  text-align: center;
  margin-bottom: 32px;
}

.plan-icon-wrapper {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, var(--plan-color), color-mix(in srgb, var(--plan-color) 80%, white));
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 24px;
  transition: transform 0.3s ease;
}

.pricing-card:hover .plan-icon-wrapper {
  transform: scale(1.1) rotate(5deg);
}

.plan-icon {
  color: white;
}

.plan-name {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 16px;
  color: var(--text-primary);
}

.plan-price {
  margin-bottom: 16px;
}

.price {
  font-size: 48px;
  font-weight: 800;
  color: var(--text-primary);
  background: linear-gradient(135deg, var(--plan-color), color-mix(in srgb, var(--plan-color) 80%, white));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.period {
  font-size: 16px;
  color: var(--text-secondary);
  margin-left: 8px;
}

.plan-description {
  font-size: 16px;
  color: var(--text-secondary);
  line-height: 1.6;
}

.pricing-features {
  margin-bottom: 32px;
  flex-grow: 1;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 16px;
  color: var(--text-primary);
  transition: transform 0.2s ease;
}

.feature-item:hover {
  transform: translateX(5px);
}

.feature-item.included {
  color: var(--text-primary);
}

.feature-item:not(.included) {
  color: var(--text-secondary);
  opacity: 0.7;
}

.pricing-footer {
  text-align: center;
  margin-top: auto;
}

.plan-btn {
  width: 100%;
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
}

.plan-btn::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, var(--btn-color), color-mix(in srgb, var(--btn-color) 80%, white));
  opacity: 0;
  transition: opacity 0.3s ease;
}

.plan-btn:hover::after {
  opacity: 0.1;
}

/* FAQ Section */
.faq-section {
  padding: 96px 0;
  background: white;
}

.faq-container {
  max-width: 800px;
  margin: 0 auto;
}

.faq-item {
  background: var(--background-light);
  border-radius: 16px;
  margin-bottom: 16px;
  cursor: pointer;
  transition: all 0.3s ease;
  overflow: hidden;
}

.faq-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

.faq-item.expanded {
  background: white;
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
}

.faq-question-wrapper {
  padding: 24px;
  display: flex;
  align-items: center;
  gap: 16px;
}

.faq-icon {
  width: 40px;
  height: 40px;
  background: rgba(37,99,235,0.1);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.faq-question {
  font-size: 18px;
  font-weight: 600;
  color: var(--text-primary);
  margin: 0;
  flex-grow: 1;
}

.faq-arrow {
  color: var(--text-secondary);
  transition: transform 0.3s ease;
}

.faq-arrow.rotated {
  transform: rotate(180deg);
}

.faq-answer-wrapper {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out, padding 0.3s ease;
}

.faq-answer-wrapper.expanded {
  max-height: 200px;
  padding: 0 24px 24px 80px;
}

.faq-answer {
  font-size: 16px;
  color: var(--text-secondary);
  line-height: 1.6;
  margin: 0;
}

/* CTA Section */
.pricing-cta-section {
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
@media (max-width: 1200px) {
  .pricing-cards-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 960px) {
  .pricing-cards-container {
    grid-template-columns: 1fr;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
  }

  .pricing-card.popular {
    transform: scale(1);
  }

  .pricing-card.popular:hover {
    transform: translateY(-5px);
  }
}

@media (max-width: 600px) {
  .pricing-card {
    padding: 32px 24px;
  }

  .plan-icon-wrapper {
    width: 60px;
    height: 60px;
  }

  .price {
    font-size: 36px;
  }
}
</style>
