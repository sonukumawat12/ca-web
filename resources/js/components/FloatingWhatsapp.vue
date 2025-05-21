<template>
  <div
    class="floating-whatsapp"
    :style="{ left: position.x + 'px', top: position.y + 'px' }"
    @mousedown="startDrag"
    @touchstart="startDrag"
    ref="floatBtn"
  >
    <a
      href="https://wa.me/919314507298"
      target="_blank"
      rel="noopener"
      aria-label="Chat on WhatsApp"
    >
      <i class="bi bi-whatsapp"></i>
    </a>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';

const position = ref({ x: 0, y: 0 });
const dragging = ref(false);
const offset = ref({ x: 0, y: 0 });
const floatBtn = ref<HTMLElement | null>(null);

const setInitialPosition = () => {
  // Default: 24px from right, 24px from bottom
  const btn = floatBtn.value;
  if (btn) {
    const winW = window.innerWidth;
    const winH = window.innerHeight;
    const btnW = btn.offsetWidth;
    const btnH = btn.offsetHeight;
    position.value.x = winW - btnW - 24;
    position.value.y = winH - btnH - 24;
  }
};

const onDrag = (e: MouseEvent | TouchEvent) => {
  if (!dragging.value) return;
  let clientX, clientY;
  if (e instanceof TouchEvent) {
    clientX = e.touches[0].clientX;
    clientY = e.touches[0].clientY;
  } else {
    clientX = e.clientX;
    clientY = e.clientY;
  }
  position.value.x = clientX - offset.value.x;
  position.value.y = clientY - offset.value.y;
};

const stopDrag = () => {
  dragging.value = false;
  window.removeEventListener('mousemove', onDrag);
  window.removeEventListener('mouseup', stopDrag);
  window.removeEventListener('touchmove', onDrag);
  window.removeEventListener('touchend', stopDrag);
};

const startDrag = (e: MouseEvent | TouchEvent) => {
  dragging.value = true;
  let clientX, clientY;
  if (e instanceof TouchEvent) {
    clientX = e.touches[0].clientX;
    clientY = e.touches[0].clientY;
  } else {
    clientX = e.clientX;
    clientY = e.clientY;
  }
  const btn = floatBtn.value;
  if (btn) {
    const rect = btn.getBoundingClientRect();
    offset.value.x = clientX - rect.left;
    offset.value.y = clientY - rect.top;
  }
  window.addEventListener('mousemove', onDrag);
  window.addEventListener('mouseup', stopDrag);
  window.addEventListener('touchmove', onDrag);
  window.addEventListener('touchend', stopDrag);
};

onMounted(() => {
  setTimeout(setInitialPosition, 100); // Wait for render
  window.addEventListener('resize', setInitialPosition);
});
onBeforeUnmount(() => {
  window.removeEventListener('resize', setInitialPosition);
});
</script>

<style scoped>
.floating-whatsapp {
  position: fixed;
  z-index: 9999;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #25d366;
  box-shadow: 0 4px 24px rgba(37, 211, 102, 0.18);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: grab;
  transition: box-shadow 0.2s, background 0.2s;
  user-select: none;
  animation: float-whatsapp 2.8s ease-in-out infinite;
}
@keyframes float-whatsapp {
  0% { transform: translateY(0); }
  50% { transform: translateY(-12px); }
  100% { transform: translateY(0); }
}
.floating-whatsapp:active {
  cursor: grabbing;
  box-shadow: 0 8px 32px rgba(37, 211, 102, 0.28);
}
.floating-whatsapp a {
  color: #fff;
  font-size: 2.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  text-decoration: none;
}
.floating-whatsapp a:hover {
  background: #22c55e;
}
@media (max-width: 600px) {
  .floating-whatsapp {
    width: 48px;
    height: 48px;
  }
  .floating-whatsapp a {
    font-size: 1.5rem;
  }
}
</style>
