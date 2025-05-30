<template>
  <AppLayout>
    <v-container fluid class="pa-6">
      <div class="d-flex align-center justify-space-between mb-6">
        <div>
          <h1 class="text-h4 font-weight-bold primary--text mb-2">Testimonial Management</h1>
          <p class="text-subtitle-1 text-medium-emphasis">Manage testimonials from your clients or users</p>
        </div>
        <v-btn color="primary" elevation="2" prepend-icon="mdi-plus" size="large" @click="openDialog()">
          Add Testimonial
        </v-btn>
      </div>
      <v-card class="rounded-lg" elevation="2">
        <v-card-text class="pa-6">
          <v-data-table :headers="headers" :items="testimonials" :items-per-page="10" class="elevation-0"
            :footer-props="{ 'items-per-page-options': [5, 10, 20, 50], 'items-per-page-text': 'Rows per page' }">
            <template #[`item.profile`]="{ item }">
              <v-avatar size="40" class="my-2">
                <img :src="item.profile" alt="Profile" />
              </v-avatar>
            </template>
            <template #[`item.name`]="{ item }">
              <div class="font-weight-medium">{{ item.name }}</div>
            </template>
            <template #[`item.position`]="{ item }">
              <div class="text-medium-emphasis">{{ item.position }}</div>
            </template>
            <template #[`item.text`]="{ item }">
              <div class="text-body-2">{{ item.text }}</div>
            </template>
            <template #[`item.social_media`]="{ item }">
              <v-btn v-if="item.social_media" icon size="small" color="primary" variant="text" :href="item.social_media" target="_blank">
                <v-icon>mdi-linkedin</v-icon>
              </v-btn>
            </template>
            <template #[`item.actions`]="{ item }">
              <div class="d-flex gap-2">
                <v-btn icon size="small" color="primary" variant="text" @click="editTestimonial(item)">
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon size="small" color="error" variant="text" @click="deleteTestimonial(item)">
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
              </div>
            </template>
            <template #no-data>
              <v-container class="fill-height">
                <v-row align="center" justify="center">
                  <v-col cols="12" sm="8" md="6" lg="4" class="text-center">
                    <v-icon size="64" color="grey-lighten-1" class="mb-4">mdi-account-voice</v-icon>
                    <h3 class="text-h6 mb-2">No Testimonials Found</h3>
                    <p class="text-body-2 text-medium-emphasis mb-4">Add your first testimonial to get started</p>
                    <v-btn color="primary" @click="openDialog()">Add Testimonial</v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
      <v-dialog v-model="dialog" max-width="700px" persistent>
        <v-card class="rounded-lg">
          <div class="team-dialog-header">
            <v-card-title class="d-flex align-center pa-6 pb-4">
              <div class="d-flex align-center">
                <div class="header-icon-wrapper">
                  <v-icon size="32" color="white">{{ isEditing ? 'mdi-pencil' : 'mdi-account-plus' }}</v-icon>
                </div>
                <span class="text-h4 font-weight-bold text-white ml-4">{{ isEditing ? 'Edit Testimonial' : 'Add Testimonial' }}</span>
              </div>
              <v-spacer />
              <v-btn icon variant="text" color="white" @click="closeDialog">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-card-title>
          </div>
          <v-card-text class="pa-6">
            <v-form ref="formRef" @submit.prevent="submitTestimonial">
              <v-row>
                <v-col cols="12" md="6">
                  <v-text-field v-model="form.name" label="Full Name" variant="outlined" :rules="[v => !!v || 'Name is required']" required />
                  <v-text-field v-model="form.position" label="Position/Company" variant="outlined" :rules="[v => !!v || 'Position is required']" required />
                  <v-textarea v-model="form.text" label="Testimonial" variant="outlined" rows="4" :rules="[v => !!v || 'Testimonial is required']" required />
                </v-col>
                <v-col cols="12" md="6">
                  <v-file-input v-model="form.profile" label="Profile Image" variant="outlined" accept="image/*" prepend-icon="mdi-camera" :rules="[v => !v || v.size < 5000000 || 'Image size should be less than 5 MB', v => !v || v.type.startsWith('image/') || 'File must be an image']" @change="handleImageUpload" />
                  <div v-if="imagePreview" class="mt-4">
                    <v-img :src="imagePreview" max-height="200" cover class="rounded-lg"></v-img>
                  </div>
                  <v-text-field v-model="form.social_media" label="Social Media Link" variant="outlined" prepend-icon="mdi-linkedin" class="mt-4" />
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions class="pa-6">
            <v-spacer />
            <v-btn variant="outlined" color="grey-darken-1" @click="closeDialog" class="px-8" size="large">Cancel</v-btn>
            <v-btn color="primary" @click="submitTestimonial" :loading="loading" class="ml-4 px-8" elevation="2" size="large">{{ isEditing ? 'Update Testimonial' : 'Add Testimonial' }}</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </AppLayout>
</template>
<script setup lang="ts">
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import type { DataTableHeader } from 'vuetify'
interface Testimonial {
  id: number
  name: string
  position: string
  text: string
  profile: string
  social_media: string
}
interface FormData {
  name: string
  position: string
  text: string
  profile: File | null
  social_media: string
}
const testimonials = ref<Testimonial[]>([
  {
    id: 1,
    name: 'Rajesh Sharma',
    position: 'CEO, Sharma Enterprises',
    text: 'Their tax planning and compliance services have been invaluable to our business. The team\'s expertise in corporate taxation helped us optimize our tax structure significantly.',
    profile: 'https://i.pravatar.cc/150?img=1',
    social_media: 'https://linkedin.com/in/rajeshsharma'
  },
  {
    id: 2,
    name: 'Priya Patel',
    position: 'Founder, TechStart Solutions',
    text: 'As a growing startup, their guidance on financial structuring and compliance has been crucial. Their proactive approach to accounting has helped us make better business decisions.',
    profile: 'https://i.pravatar.cc/150?img=2',
    social_media: 'https://linkedin.com/in/priyapatel'
  },
  {
    id: 3,
    name: 'Amit Kumar',
    position: 'Managing Director, Global Imports Ltd',
    text: 'Their expertise in international taxation and transfer pricing has been exceptional. They\'ve helped us navigate complex cross-border transactions with confidence.',
    profile: 'https://i.pravatar.cc/150?img=3',
    social_media: 'https://linkedin.com/in/amitkumar'
  },
  {
    id: 4,
    name: 'Neha Gupta',
    position: 'CFO, Healthcare Innovations',
    text: 'The audit team\'s thoroughness and attention to detail is remarkable. Their insights have helped us strengthen our internal controls and financial reporting.',
    profile: 'https://i.pravatar.cc/150?img=4',
    social_media: 'https://linkedin.com/in/nehagupta'
  },
  {
    id: 5,
    name: 'Vikram Singh',
    position: 'Owner, Singh Manufacturing',
    text: 'Their GST compliance and advisory services have been outstanding. They\'ve helped us streamline our tax processes and stay compliant with changing regulations.',
    profile: 'https://i.pravatar.cc/150?img=5',
    social_media: 'https://linkedin.com/in/vikramsingh'
  },
  {
    id: 6,
    name: 'Meera Kapoor',
    position: 'Director, Real Estate Ventures',
    text: 'Their expertise in real estate accounting and tax planning has been invaluable. They\'ve helped us optimize our investment structure and maximize returns.',
    profile: 'https://i.pravatar.cc/150?img=6',
    social_media: 'https://linkedin.com/in/meerakapoor'
  },
  {
    id: 7,
    name: 'Arjun Reddy',
    position: 'CEO, Digital Solutions',
    text: 'Their advisory on business restructuring and M&A transactions has been exceptional. They\'ve helped us make informed decisions that have significantly grown our business.',
    profile: 'https://i.pravatar.cc/150?img=7',
    social_media: 'https://linkedin.com/in/arjunreddy'
  },
  {
    id: 8,
    name: 'Sneha Verma',
    position: 'Founder, E-commerce Platform',
    text: 'Their expertise in e-commerce taxation and digital business accounting has been crucial for our growth. They\'ve helped us navigate complex tax implications of online transactions.',
    profile: 'https://i.pravatar.cc/150?img=8',
    social_media: 'https://linkedin.com/in/snehaverma'
  },
  {
    id: 9,
    name: 'Rahul Mehta',
    position: 'Managing Partner, Law Firm',
    text: 'Their professional services have been outstanding. From tax planning to compliance, they\'ve provided us with reliable and timely solutions that have helped us focus on our core business.',
    profile: 'https://i.pravatar.cc/150?img=9',
    social_media: 'https://linkedin.com/in/rahulmehta'
  },
  {
    id: 10,
    name: 'Anita Desai',
    position: 'CEO, Educational Institute',
    text: 'Their expertise in non-profit accounting and tax compliance has been invaluable. They\'ve helped us maintain transparency and meet all regulatory requirements effectively.',
    profile: 'https://i.pravatar.cc/150?img=10',
    social_media: 'https://linkedin.com/in/anitadesai'
  }
])
const headers = ref<readonly DataTableHeader[]>([
  { title: 'Profile', key: 'profile', sortable: false, align: 'center' },
  { title: 'Name', key: 'name', sortable: true, align: 'start' },
  { title: 'Position', key: 'position', sortable: true, align: 'start' },
  { title: 'Testimonial', key: 'text', sortable: false, align: 'start' },
  { title: 'Social Media', key: 'social_media', sortable: false, align: 'center' },
  { title: 'Actions', key: 'actions', sortable: false, align: 'center' }
] as const)
const dialog = ref(false)
const loading = ref(false)
const formRef = ref<{ validate: () => boolean } | null>(null)
const isEditing = ref(false)
const imagePreview = ref<string | null>(null)
const form = ref<FormData>({ name: '', position: '', text: '', profile: null, social_media: '' })
const editingId = ref<number | null>(null)
function openDialog() { resetForm(); dialog.value = true }
function closeDialog() { dialog.value = false; resetForm() }
function handleImageUpload(event: Event) {
  const input = event.target as HTMLInputElement
  if (input.files && input.files[0]) {
    const file = input.files[0]
    form.value.profile = file
    const reader = new FileReader()
    reader.onload = (e) => { imagePreview.value = e.target?.result as string }
    reader.readAsDataURL(file)
  }
}
function resetForm() {
  form.value = { name: '', position: '', text: '', profile: null, social_media: '' }
  imagePreview.value = null
  isEditing.value = false
  editingId.value = null
}
function editTestimonial(item: Testimonial) {
  isEditing.value = true
  editingId.value = item.id
  form.value = { name: item.name, position: item.position, text: item.text, profile: null, social_media: item.social_media }
  imagePreview.value = item.profile
  dialog.value = true
}
function deleteTestimonial(item: Testimonial) {
  if (confirm('Are you sure you want to delete this testimonial?')) {
    testimonials.value = testimonials.value.filter(t => t.id !== item.id)
  }
}
function submitTestimonial() {
  if (!formRef.value?.validate()) return
  loading.value = true
  setTimeout(() => {
    if (isEditing.value && editingId.value !== null) {
      const idx = testimonials.value.findIndex(t => t.id === editingId.value)
      if (idx !== -1) {
        testimonials.value[idx] = { ...testimonials.value[idx], ...form.value, profile: imagePreview.value || testimonials.value[idx].profile }
      }
    } else {
      testimonials.value.push({ id: testimonials.value.length + 1, ...form.value, profile: imagePreview.value || 'https://i.pravatar.cc/150' })
    }
    closeDialog()
    loading.value = false
  }, 800)
}
</script>
<style scoped>
.v-data-table { font-size: 14px; }
.v-card { transition: all 0.3s ease; }
.v-btn { text-transform: none; letter-spacing: 0.5px; }
.team-dialog-header { background: linear-gradient(135deg, #1976D2 0%, #2196F3 100%); border-radius: 8px 8px 0 0; }
.header-icon-wrapper { background: rgba(255, 255, 255, 0.2); border-radius: 12px; padding: 8px; }
.v-text-field, .v-textarea { border-radius: 8px; }
</style>
