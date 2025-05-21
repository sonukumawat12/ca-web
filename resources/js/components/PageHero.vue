<script setup lang="ts">
defineProps<{
  title: string;
  subtitle?: string;
  backgroundImage?: string;
  badge?: string;
}>();
</script>

<template>
  <section
    class="page-hero"
    :style="{
      backgroundImage: `url(${backgroundImage || 'https://picsum.photos/seed/default/1920/1080'})`,
      backgroundPosition: 'center',
      backgroundSize: 'cover',
      backgroundRepeat: 'no-repeat'
    }"
  >
    <div class="hero-overlay"></div>
    <div class="hero-shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
    </div>
    <v-container>
      <div class="hero-content">
        <div v-if="badge" class="hero-badge">
          <span class="badge-text">{{ badge }}</span>
          <div class="badge-line"></div>
        </div>
        <h1 class="hero-title">
          <span class="title-line">{{ title }}</span>
        </h1>
        <p v-if="subtitle" class="hero-subtitle">{{ subtitle }}</p>
        <div class="hero-scroll-indicator">
          <div class="scroll-line"></div>
          <span>Scroll Down</span>
        </div>
      </div>
    </v-container>
  </section>
</template>

<style scoped>
.page-hero {
  position: relative;
  height: 80vh;
  min-height: 600px;
  display: flex;
  align-items: center;
  color: white;
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg,
    rgba(0, 0, 0, 0.95) 0%,
    rgba(0, 0, 0, 0.8) 50%,
    rgba(0, 0, 0, 0.6) 100%
  );
  z-index: 1;
}

.hero-shapes {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.shape {
  position: absolute;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
  backdrop-filter: blur(10px);
}

.shape-1 {
  width: 300px;
  height: 300px;
  top: -100px;
  right: -100px;
  animation: float 8s ease-in-out infinite;
}

.shape-2 {
  width: 200px;
  height: 200px;
  bottom: -50px;
  left: -50px;
  animation: float 6s ease-in-out infinite reverse;
}

.shape-3 {
  width: 150px;
  height: 150px;
  top: 50%;
  right: 10%;
  animation: float 7s ease-in-out infinite 1s;
}

.hero-content {
  position: relative;
  z-index: 2;
  max-width: 900px;
  margin: 0 auto;
  text-align: center;
  padding: 0 20px;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(10px);
  padding: 8px 24px;
  border-radius: 32px;
  margin-bottom: 32px;
  border: 1px solid rgba(255,255,255,0.2);
  transform: translateY(20px);
  opacity: 0;
  animation: fadeInUp 0.8s ease-out forwards;
}

.badge-text {
  font-weight: 600;
  font-size: 16px;
  background: linear-gradient(to right, #fff, #e0e0e0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.badge-line {
  width: 30px;
  height: 2px;
  background: linear-gradient(to right, rgba(255,255,255,0.5), transparent);
}

.hero-title {
  font-size: 72px;
  font-weight: 800;
  line-height: 1.1;
  margin-bottom: 24px;
  transform: translateY(20px);
  opacity: 0;
  animation: fadeInUp 0.8s ease-out forwards 0.2s;
}

.title-line {
  background: linear-gradient(to right, #fff, #e0e0e0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
  position: relative;
}

.title-line::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(to right, var(--primary-color), transparent);
  transform: scaleX(0);
  transform-origin: left;
  animation: lineReveal 1s ease-out forwards 1s;
}

.hero-subtitle {
  font-size: 20px;
  opacity: 0.9;
  max-width: 600px;
  margin: 0 auto 48px;
  transform: translateY(20px);
  opacity: 0;
  animation: fadeInUp 0.8s ease-out forwards 0.4s;
}

.hero-scroll-indicator {
  position: absolute;
  bottom: 40px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  opacity: 0;
  animation: fadeIn 0.8s ease-out forwards 1s;
}

.scroll-line {
  width: 2px;
  height: 40px;
  background: linear-gradient(to bottom, rgba(255,255,255,0.8), transparent);
  animation: scrollLine 2s ease-in-out infinite;
}

.hero-scroll-indicator span {
  font-size: 14px;
  opacity: 0.7;
}

@keyframes fadeInUp {
  from {
    transform: translateY(20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes lineReveal {
  from {
    transform: scaleX(0);
  }
  to {
    transform: scaleX(1);
  }
}

@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-20px);
  }
}

@keyframes scrollLine {
  0%, 100% {
    height: 40px;
    opacity: 0.8;
  }
  50% {
    height: 60px;
    opacity: 0.4;
  }
}

@media (max-width: 960px) {
  .page-hero {
    height: 70vh;
  }

  .hero-title {
    font-size: 56px;
  }

  .hero-subtitle {
    font-size: 18px;
  }

  .shape-1 {
    width: 200px;
    height: 200px;
  }

  .shape-2 {
    width: 150px;
    height: 150px;
  }

  .shape-3 {
    width: 100px;
    height: 100px;
  }
}

@media (max-width: 600px) {
  .page-hero {
    height: 60vh;
  }

  .hero-title {
    font-size: 40px;
  }

  .hero-subtitle {
    font-size: 16px;
  }

  .hero-badge {
    padding: 6px 20px;
    font-size: 14px;
  }

  .shape-1, .shape-2, .shape-3 {
    display: none;
  }
}
</style>
