<script setup lang="ts">
import FrontEndLayout from '@/layouts/FrontEndLayput.vue';
import FooterSection from '@/components/FooterSection.vue';
import { ref } from 'vue';

const teamMembers = [
  {
    name: 'Rajesh Kumar',
    role: 'Founder & CEO',
    image: 'https://randomuser.me/api/portraits/men/32.jpg',
    bio: 'Chartered Accountant with 20+ years of experience in financial consulting and business advisory.',
    social: {
      linkedin: '#',
      twitter: '#'
    }
  },
  {
    name: 'Priya Sharma',
    role: 'Senior Tax Consultant',
    image: 'https://randomuser.me/api/portraits/women/44.jpg',
    bio: 'Specialized in corporate taxation and international tax planning with 15 years of expertise.',
    social: {
      linkedin: '#',
      twitter: '#'
    }
  },
  {
    name: 'Amit Patel',
    role: 'Audit Director',
    image: 'https://randomuser.me/api/portraits/men/67.jpg',
    bio: 'Expert in statutory audits and internal controls with extensive experience in risk management.',
    social: {
      linkedin: '#',
      twitter: '#'
    }
  },
  {
    name: 'Neha Gupta',
    role: 'Business Advisory Head',
    image: 'https://randomuser.me/api/portraits/women/68.jpg',
    bio: 'Strategic business consultant specializing in growth strategies and financial planning.',
    social: {
      linkedin: '#',
      twitter: '#'
    }
  }
];

const achievements = [
  {
    number: '15+',
    label: 'Years of Excellence',
    icon: 'mdi-trophy'
  },
  {
    number: '500+',
    label: 'Happy Clients',
    icon: 'mdi-account-group'
  },
  {
    number: '50+',
    label: 'Expert Team Members',
    icon: 'mdi-account-tie'
  },
  {
    number: '1000+',
    label: 'Projects Completed',
    icon: 'mdi-check-circle'
  }
];

const values = [
  {
    title: 'Integrity',
    description: 'We maintain the highest standards of professional ethics and transparency in all our dealings.',
    icon: 'mdi-shield-check',
    color: '#4CAF50'
  },
  {
    title: 'Excellence',
    description: 'We strive for excellence in every aspect of our service delivery and client interactions.',
    icon: 'mdi-star',
    color: '#FFC107'
  },
  {
    title: 'Innovation',
    description: 'We continuously innovate our processes and solutions to better serve our clients.',
    icon: 'mdi-lightbulb',
    color: '#2196F3'
  },
  {
    title: 'Client Focus',
    description: 'We put our clients at the center of everything we do, ensuring their success is our priority.',
    icon: 'mdi-account-heart',
    color: '#E91E63'
  }
];
</script>

<template>
  <FrontEndLayout>
    <!-- Hero Section -->
    <section class="about-hero">
      <div class="about-hero-overlay"></div>
      <v-container>
        <div class="about-hero-content">
          <div class="hero-badge">About Us</div>
          <h1 class="about-hero-title">Building Trust Through Excellence</h1>
          <p class="about-hero-subtitle">
            Empowering businesses with innovative financial solutions since 2008
          </p>
          <div class="hero-stats">
            <div class="stat-item">
              <span class="stat-number">15+</span>
              <span class="stat-label">Years Experience</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">500+</span>
              <span class="stat-label">Happy Clients</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">50+</span>
              <span class="stat-label">Team Members</span>
            </div>
          </div>
        </div>
      </v-container>
    </section>

    <!-- Mission & Vision Section -->
    <section class="mission-vision-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">Our Purpose</span>
          <h2 class="section-title">Driving Business Success</h2>
        </div>
        <v-row>
          <v-col cols="12" md="6" class="mission-col">
            <div class="mission-content">
              <div class="section-icon">
                <v-icon icon="mdi-target" size="32"></v-icon>
              </div>
              <h2 class="section-title">Our Mission</h2>
              <p class="section-description">
                To provide exceptional financial services that empower businesses to achieve their goals through innovative solutions, expert guidance, and unwavering commitment to excellence.
              </p>
            </div>
          </v-col>
          <v-col cols="12" md="6" class="vision-col">
            <div class="vision-content">
              <div class="section-icon">
                <v-icon icon="mdi-eye" size="32"></v-icon>
              </div>
              <h2 class="section-title">Our Vision</h2>
              <p class="section-description">
                To be the most trusted financial advisory firm, recognized for our expertise, innovation, and commitment to client success in the ever-evolving business landscape.
              </p>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- Values Section -->
    <section class="values-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">Our Values</span>
          <h2 class="section-title">What We Stand For</h2>
          <p class="section-subtitle">The principles that guide our every decision</p>
        </div>
        <v-row>
          <v-col v-for="value in values" :key="value.title" cols="12" sm="6" md="3">
            <div class="value-card">
              <div class="value-icon" :style="{ background: value.color }">
                <v-icon :icon="value.icon" size="32"></v-icon>
              </div>
              <div class="value-content">
                <h3 class="value-title">{{ value.title }}</h3>
                <p class="value-description">{{ value.description }}</p>
              </div>
              <div class="value-decoration">
                <div class="decoration-circle" :style="{ background: value.color }"></div>
                <div class="decoration-line" :style="{ background: value.color }"></div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- Team Section -->
    <section class="team-section">
      <v-container>
        <div class="section-header">
          <span class="section-badge">Our Team</span>
          <h2 class="section-title">Meet Our Experts</h2>
          <p class="section-subtitle">Dedicated professionals committed to your success</p>
        </div>
        <v-row>
          <v-col v-for="member in teamMembers" :key="member.name" cols="12" sm="6" md="3">
            <div class="team-card">
              <div class="team-image-wrapper">
                <img :src="member.image" :alt="member.name" class="team-image">
                <div class="team-social">
                  <a :href="member.social.linkedin" class="social-link">
                    <v-icon icon="mdi-linkedin"></v-icon>
                  </a>
                  <a :href="member.social.twitter" class="social-link">
                    <v-icon icon="mdi-twitter"></v-icon>
                  </a>
                </div>
              </div>
              <div class="team-info">
                <h3 class="team-name">{{ member.name }}</h3>
                <div class="team-role">{{ member.role }}</div>
                <p class="team-bio">{{ member.bio }}</p>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>

    <!-- CTA Section -->
    <section class="about-cta-section">
      <div class="cta-background">
        <div class="cta-overlay"></div>
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
            >
              Get Started
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
/* About Hero Section */
.about-hero {
  position: relative;
  height: 85vh;
  min-height: 600px;
  background-position: center;
  background: url('/images/team.jpg') center/cover no-repeat;
  display: flex;
  align-items: center;
  color: white;
  overflow: hidden;
}

.about-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(0,0,0,0.9), rgba(0,0,0,0.4));
}

.about-hero-content {
  position: relative;
  z-index: 1;
  max-width: 1000px;
  margin: 0 auto;
  text-align: center;
}

.hero-badge {
  display: inline-block;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(10px);
  padding: 8px 24px;
  border-radius: 32px;
  font-weight: 600;
  margin-bottom: 32px;
  border: 1px solid rgba(255,255,255,0.2);
}

.about-hero-title {
  font-size: 64px;
  font-weight: 800;
  margin-bottom: 24px;
  line-height: 1.2;
  background: linear-gradient(to right, #fff, #e0e0e0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.about-hero-subtitle {
  font-size: 24px;
  opacity: 0.9;
  max-width: 700px;
  margin: 0 auto 48px;
}

.hero-stats {
  display: flex;
  justify-content: center;
  gap: 64px;
  margin-top: 48px;
}

.stat-item {
  text-align: center;
}

.stat-number {
  display: block;
  font-size: 48px;
  font-weight: 800;
  margin-bottom: 8px;
  background: linear-gradient(135deg, #fff, #e0e0e0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.stat-label {
  font-size: 16px;
  opacity: 0.8;
}

/* Mission & Vision Section */
.mission-vision-section {
  padding: 120px 0;
  background: var(--background-light);
}

.section-header {
  text-align: center;
  margin-bottom: 80px;
}

.section-badge {
  display: inline-block;
  background: rgba(37,99,235,0.1);
  color: var(--primary-color);
  padding: 8px 24px;
  border-radius: 32px;
  font-weight: 600;
  margin-bottom: 16px;
}

.section-title {
  font-size: 40px;
  font-weight: 800;
  margin-bottom: 16px;
  color: var(--text-primary);
}

.section-subtitle {
  font-size: 18px;
  color: var(--text-secondary);
  max-width: 600px;
  margin: 0 auto;
}

.mission-content,
.vision-content {
  background: white;
  padding: 48px;
  border-radius: 24px;
  height: 100%;
  box-shadow: 0 20px 40px rgba(0,0,0,0.05);
  transition: all 0.4s ease;
  border: 1px solid rgba(0,0,0,0.05);
}

.mission-content:hover,
.vision-content:hover {
  transform: translateY(-10px);
  box-shadow: 0 30px 60px rgba(0,0,0,0.1);
}

.section-icon {
  width: 72px;
  height: 72px;
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 32px;
  color: white;
  transform: rotate(-5deg);
  transition: transform 0.3s ease;
}

.mission-content:hover .section-icon,
.vision-content:hover .section-icon {
  transform: rotate(0deg);
}

/* Values Section */
.values-section {
  padding: 120px 0;
  background: var(--background-light);
  position: relative;
  overflow: hidden;
}

.values-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at top right, rgba(37,99,235,0.05), transparent 70%);
  pointer-events: none;
}

.value-card {
  background: white;
  padding: 40px;
  border-radius: 24px;
  height: 100%;
  box-shadow: 0 20px 40px rgba(0,0,0,0.05);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  border: 1px solid rgba(0,0,0,0.05);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.value-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 30px 60px rgba(0,0,0,0.1);
}

.value-icon {
  width: 72px;
  height: 72px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  transform: rotate(-5deg);
  transition: transform 0.3s ease;
  position: relative;
  z-index: 1;
}

.value-card:hover .value-icon {
  transform: rotate(0deg);
}

.value-content {
  position: relative;
  z-index: 1;
}

.value-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 16px;
  color: var(--text-primary);
  position: relative;
  display: inline-block;
}

.value-title::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 40px;
  height: 3px;
  background: currentColor;
  transition: width 0.3s ease;
}

.value-card:hover .value-title::after {
  width: 100%;
}

.value-description {
  font-size: 16px;
  color: var(--text-secondary);
  line-height: 1.6;
  margin: 0;
}

.value-decoration {
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  opacity: 0.1;
  transition: opacity 0.3s ease;
}

.value-card:hover .value-decoration {
  opacity: 0.15;
}

.decoration-circle {
  position: absolute;
  top: -100px;
  right: -100px;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  filter: blur(40px);
}

.decoration-line {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 4px;
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.4s ease;
}

.value-card:hover .decoration-line {
  transform: scaleX(1);
  transform-origin: left;
}

/* Team Section */
.team-section {
  padding: 120px 0;
  background: var(--background-light);
}

.team-card {
  background: white;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0,0,0,0.05);
  transition: all 0.4s ease;
  border: 1px solid rgba(0,0,0,0.05);
}

.team-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 30px 60px rgba(0,0,0,0.1);
}

.team-image-wrapper {
  position: relative;
  padding-top: 100%;
  overflow: hidden;
}

.team-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.team-card:hover .team-image {
  transform: scale(1.1);
}

.team-social {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 24px;
  background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
  display: flex;
  gap: 16px;
  opacity: 0;
  transform: translateY(100%);
  transition: all 0.4s ease;
}

.team-card:hover .team-social {
  opacity: 1;
  transform: translateY(0);
}

.social-link {
  color: white;
  text-decoration: none;
  transition: transform 0.3s ease;
  width: 40px;
  height: 40px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(10px);
}

.social-link:hover {
  transform: translateY(-3px);
  background: rgba(255,255,255,0.2);
}

.team-info {
  padding: 32px;
}

.team-name {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 8px;
  color: var(--text-primary);
}

.team-role {
  font-size: 16px;
  color: var(--primary-color);
  margin-bottom: 16px;
  font-weight: 600;
}

.team-bio {
  font-size: 15px;
  color: var(--text-secondary);
  line-height: 1.6;
}

/* CTA Section */
.about-cta-section {
  position: relative;
  padding: 120px 0;
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
  background: linear-gradient(135deg, rgba(0,0,0,0.9), rgba(0,0,0,0.4));
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
  background: linear-gradient(to right, #fff, #e0e0e0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.cta-subtitle {
  font-size: 20px;
  opacity: 0.9;
  margin-bottom: 48px;
}

.cta-buttons {
  display: flex;
  gap: 24px;
  justify-content: center;
}

.primary-btn {
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
  color: white !important;
  padding: 16px 32px !important;
  border-radius: 12px !important;
  transition: transform 0.3s ease !important;
}

.primary-btn:hover {
  transform: translateY(-3px);
}

.secondary-btn {
  border: 2px solid rgba(255,255,255,0.2) !important;
  color: white !important;
  padding: 16px 32px !important;
  border-radius: 12px !important;
  transition: all 0.3s ease !important;
}

.secondary-btn:hover {
  background: rgba(255,255,255,0.1) !important;
  transform: translateY(-3px);
}

/* Responsive Design */
@media (max-width: 960px) {
  .about-hero {
    height: 70vh;
  }

  .about-hero-title {
    font-size: 48px;
  }

  .about-hero-subtitle {
    font-size: 20px;
  }

  .hero-stats {
    gap: 32px;
  }

  .stat-number {
    font-size: 36px;
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

  .value-card {
    padding: 32px;
  }

  .value-icon {
    width: 64px;
    height: 64px;
  }

  .value-title {
    font-size: 20px;
  }
}

@media (max-width: 600px) {
  .about-hero {
    height: 60vh;
  }

  .about-hero-title {
    font-size: 36px;
  }

  .hero-stats {
    flex-direction: column;
    gap: 24px;
  }

  .mission-content,
  .vision-content {
    padding: 32px;
  }

  .value-card {
    padding: 24px;
  }

  .team-info {
    padding: 24px;
  }

  .value-icon {
    width: 56px;
    height: 56px;
  }

  .value-title {
    font-size: 18px;
  }

  .value-description {
    font-size: 14px;
  }
}
</style>
