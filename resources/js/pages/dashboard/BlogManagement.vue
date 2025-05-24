<template>
  <AppLayout>
    <v-container fluid class="pa-6">
      <!-- Header Section -->
      <div class="d-flex align-center justify-space-between mb-6">
        <div>
          <h1 class="text-h4 font-weight-bold primary--text mb-2">Blog Management</h1>
          <p class="text-subtitle-1 text-medium-emphasis">Manage and organize your blog content</p>
        </div>
        <v-btn
          color="primary"
          elevation="2"
          prepend-icon="mdi-plus"
          size="large"
          @click="openDialog()"
        >
          Create New Blog
        </v-btn>
      </div>

      <!-- Main Content Card -->
      <v-card class="rounded-lg" elevation="2">
        <v-card-text class="pa-6">
          <v-data-table
            :headers="headers"
            :items="filteredBlogs"
            :items-per-page="10"
            class="elevation-0"
            :footer-props="{
              'items-per-page-options': [5, 10, 20, 50],
              'items-per-page-text': 'Rows per page'
            }"
          >
            <!-- Image Column -->
             
            <template v-slot:item.image="scope">
              <v-avatar size="40" class="my-2">
                
                <img :src="scope.item.image" />
              </v-avatar>
            </template>

            <!-- Blog Post Title Column -->
            <template v-slot:item.title="scope">
              <div class="font-weight-medium">{{ scope.item.title }}</div>
            </template>

            <!-- Status Column -->
            <template v-slot:item.is_published="scope">
              <v-chip
                :color="getStatusColor(scope.item)"
                size="small"
                class="font-weight-medium"
                :class="getStatusTextClass(scope.item)"
                variant="tonal"
              >
                <v-icon start size="small" :icon="getStatusIcon(scope.item)"></v-icon>
                {{ getStatusText(scope.item) }}
              </v-chip>
            </template>

            <!-- Published Date Column -->
            <template v-slot:item.published_at="scope">
              <span class="text-medium-emphasis">{{ formatDate(scope.item.published_at) }}</span>
            </template>

            <!-- No Data Template -->
            <template #no-data>
              <v-container class="fill-height">
                <v-row align="center" justify="center">
                  <v-col cols="12" sm="8" md="6" lg="4" class="text-center">
                    <v-icon size="64" color="grey-lighten-1" class="mb-4">mdi-file-document-outline</v-icon>
                    <h3 class="text-h6 mb-2">No Blog Posts Found</h3>
                    <p class="text-body-2 text-medium-emphasis mb-4">Try adjusting your filters or create a new blog post</p>
                    <v-btn color="primary" @click="openDialog()">Create New Blog</v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>

      <!-- Create/Edit Blog Dialog -->
      <v-dialog v-model="dialog" max-width="950px" persistent>
        <v-card class="rounded-lg">
          <!-- Header with Gradient Background -->
          <div class="blog-dialog-header">
            <v-card-title class="d-flex align-center pa-6 pb-4">
              <div class="d-flex align-center">
                <div class="header-icon-wrapper">
                  <v-icon size="32" color="white">{{ isEditing ? 'mdi-pencil' : 'mdi-plus-circle' }}</v-icon>
                </div>
                <span class="text-h4 font-weight-bold text-white ml-4">{{ isEditing ? 'Edit Blog' : 'Create New Blog' }}</span>
              </div>
              <v-spacer />
              <v-btn icon variant="text" color="white" @click="closeDialog">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-card-title>
          </div>

          <v-card-text class="pa-4" style="max-height: none; overflow-y: visible;">
            <v-form ref="formRef" @submit.prevent="submitBlog">
              <v-row>
                <!-- Left Column - Main Content -->
                <v-col cols="12" md="8">
                  <!-- Title Section -->
                  <v-card variant="flat" class="mb-4 blog-card">
                    <v-card-text class="pa-4">
                      <div class="text-subtitle-1 font-weight-medium mb-2 d-flex align-center">
                        <v-icon color="primary" class="mr-2">mdi-format-title</v-icon>
                        Blog Title
                      </div>
                      <v-text-field
                        v-model="form.title"
                        variant="outlined"
                        density="comfortable"
                        :rules="[v => !!v || 'Title is required']"
                        required
                        placeholder="Enter a compelling title for your blog post"
                        class="mb-4"
                        hide-details="auto"
                      />
                    </v-card-text>
                  </v-card>

                  <!-- Content Section -->
                  <v-card variant="flat" class="mb-4 blog-card">
                    <v-card-text class="pa-4">
                      <div class="text-subtitle-1 font-weight-medium mb-2 d-flex align-center">
                        <v-icon color="primary" class="mr-2">mdi-text-box</v-icon>
                        Content
                      </div>
                      <v-textarea
                        v-model="form.content"
                        variant="outlined"
                        rows="8"
                        :rules="[v => !!v || 'Content is required']"
                        required
                        placeholder="Write your blog content here..."
                        class="mb-2"
                        hide-details="auto"
                      />
                    </v-card-text>
                  </v-card>
                </v-col>

                <!-- Right Column - Settings -->
                <v-col cols="12" md="4">
                  <!-- Category Section -->
                  <v-card variant="flat" class="mb-4 blog-card">
                    <v-card-text class="pa-4">
                      <div class="text-subtitle-1 font-weight-medium mb-2 d-flex align-center">
                        <v-icon color="primary" class="mr-2">mdi-tag</v-icon>
                        Category
                      </div>
                      <v-select
                        v-model="form.category"
                        :items="categories"
                        variant="outlined"
                        density="comfortable"
                        :rules="[v => !!v || 'Category is required']"
                        required
                        hide-details="auto"
                      />
                    </v-card-text>
                  </v-card>

                  <!-- Featured Image Section -->
                  <v-card variant="flat" class="mb-4 blog-card">
                    <v-card-text class="pa-4">
                      <div class="text-subtitle-1 font-weight-medium mb-2 d-flex align-center">
                        <v-icon color="primary" class="mr-2">mdi-image</v-icon>
                        Featured Image
                      </div>
                      <v-file-input
                        v-model="form.image"
                        variant="outlined"
                        density="comfortable"
                        accept="image/*"
                        prepend-icon="mdi-camera"
                        show-size
                        :rules="[
                          v => !v || v.size < 5000000 || 'Image size should be less than 5 MB',
                          v => !v || v.type.startsWith('image/') || 'File must be an image'
                        ]"
                        class="mb-2"
                        hide-details="auto"
                        @change="handleImageUpload"
                      />
                      <div v-if="imagePreview" class="mt-4">
                        <v-img
                          :src="imagePreview"
                          max-height="200"
                          cover
                          class="rounded-lg"
                        ></v-img>
                      </div>
                      <div class="text-caption text-medium-emphasis mt-2">
                        <v-icon size="small" class="mr-1">mdi-information</v-icon>
                        Recommended size: 1200x630 pixels. Max file size: 5MB
                      </div>
                    </v-card-text>
                  </v-card>

                  <!-- Publication Settings Section -->
                  <v-card variant="flat" class="blog-card">
                    <v-card-text class="pa-4">
                      <div class="text-subtitle-1 font-weight-medium mb-4 d-flex align-center">
                        <v-icon color="primary" class="mr-2">mdi-cog</v-icon>
                        Publication Settings
                      </div>

                      <v-switch
                        v-model="form.is_published"
                        color="success"
                        label="Publish immediately"
                        hide-details
                        class="mb-4"
                      />

                      <template v-if="!form.is_published">
                        <div class="text-subtitle-2 mb-2 d-flex align-center">
                          <v-icon size="small" color="info" class="mr-2">mdi-clock-outline</v-icon>
                          Schedule Publication
                        </div>
                        <v-menu
                          v-model="scheduleMenu"
                          :close-on-content-click="false"
                          transition="scale-transition"
                        >
                          <template v-slot:activator="{ props }">
                            <v-text-field
                              v-bind="props"
                              v-model="form.scheduled_at"
                              label="Publication Date"
                              prepend-inner-icon="mdi-calendar"
                              variant="outlined"
                              density="comfortable"
                              readonly
                              class="mb-2"
                              hide-details="auto"
                            />
                          </template>
                          <v-date-picker
                            v-model="form.scheduled_at"
                            :min="new Date().toISOString().substr(0, 10)"
                          />
                        </v-menu>
                      </template>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions class="pa-6">
            <v-spacer />
            <v-btn
              variant="outlined"
              color="grey-darken-1"
              @click="closeDialog"
              class="px-8"
              size="large"
            >
              Cancel
            </v-btn>
            <v-btn
              color="primary"
              @click="submitBlog"
              :loading="loading"
              class="ml-4 px-8"
              elevation="2"
              size="large"
            >
              {{ isEditing ? 'Update Blog' : 'Create Blog' }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </AppLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import axios from 'axios'
import type { DataTableHeader } from 'vuetify'

interface User {
  id: number
  name: string
}

interface BlogItem {
  id?: number
  title: string
  category: string
  image?: string
  is_published: boolean
  scheduled_at?: string
  published_at?: string
  content: string
  slug?: string
  excerpt?: string
}

interface FormData {
  title: string
  category: string
  is_published: boolean
  image: File | null
  content: string
  scheduled_at: string | null
}

const user = computed<User>(() => usePage().props.user as User)
const categories = computed<string[]>(() => usePage().props.categories as string[])
const blogs = computed<BlogItem[]>(() => usePage().props.blogs as BlogItem[])
const filteredBlogs = computed(() => blogs.value || [])

const dialog = ref(false)
const loading = ref(false)
const formRef = ref<{ validate: () => boolean } | null>(null)
const scheduleMenu = ref(false)
const isEditing = ref(false)
const imagePreview = ref<string | null>(null)

const form = ref<FormData>({
  title: '',
  category: '',
  is_published: false,
  image: null,
  content: '',
  scheduled_at: null
})

const headers = ref<readonly DataTableHeader[]>([
  {
    title: 'Image',
    key: 'image',
    value: 'image',
    sortable: false,
    align: 'center'
  },
  {
    title: 'Title',
    key: 'title',
    value: 'title',
    sortable: false,
    align: 'start'
  },
  {
    title: 'Category',
    key: 'category',
    value: 'category',
    align: 'center',
    sortable: true
  },
  {
    title: 'excerpt',
    key: 'excerpt',
    value: 'excerpt',
    align: 'center',
    sortable: true
  },
  {
    title: 'Status',
    key: 'is_published',
    value: 'is_published',
    align: 'center',
    sortable: true
  },
  {
    title: 'Published Date',
    key: 'published_at',
    value: 'published_at',
    align: 'center',
    sortable: true
  },
  {
    title: 'Read Time',
    key: 'total_read_time',
    value: 'total_read_time',
    align: 'center',
    sortable: true
  },
  {
    title: 'View',
    key: 'view_count',
    value: 'view_count',
    align: 'center',
    sortable: true
  },
  {
    title: 'Actions',
    key: 'actions',
    value: 'actions',
    align: 'center',
    sortable: false
  }
] as const)

function getStatusColor(item: BlogItem) {
  if (item.scheduled_at) return 'info'
  return item.is_published ? 'success' : 'warning'
}

function getStatusTextClass(item: BlogItem) {
  if (item.scheduled_at) return 'info--text'
  return item.is_published ? 'success--text' : 'warning--text'
}

function getStatusIcon(item: BlogItem) {
  if (item.scheduled_at) return 'mdi-clock-outline'
  return item.is_published ? 'mdi-check-circle' : 'mdi-clock-outline'
}

function getStatusText(item: BlogItem) {
  if (item.scheduled_at) return 'Scheduled'
  return item.is_published ? 'Published' : 'Draft'
}
function formatDate(date: string | undefined): string {
  if (!date) return '-';
  return new Date(date).toLocaleString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true, // For AM/PM format
  });
}


function openDialog() {
  resetForm()
  dialog.value = true
}

function closeDialog() {
  dialog.value = false
  resetForm()
}

function handleImageUpload(event: Event) {
  const input = event.target as HTMLInputElement
  if (input.files && input.files[0]) {
    const file = input.files[0]
    form.value.image = file
    
    // Create preview URL
    const reader = new FileReader()
    reader.onload = (e) => {
      imagePreview.value = e.target?.result as string
    }
    reader.readAsDataURL(file)
  }
}

function resetForm() {
  form.value = {
    title: '',
    category: '',
    is_published: false,
    image: null,
    content: '',
    scheduled_at: null
  }
  imagePreview.value = null
  isEditing.value = false
}

function submitBlog() {
  if (!formRef.value?.validate()) return
  if (form.value.is_published) {
    scheduleMenu.value = false
  }
  loading.value = true
  const formData = new FormData()
  formData.append('title', form.value.title)
  formData.append('content', form.value.content)
  formData.append('category', form.value.category)
  formData.append('is_published', String(form.value.is_published ? 1 : 0))
  formData.append('user_id', String(user.value.id))

  if (form.value.scheduled_at && !form.value.is_published) {
    formData.append('scheduled_at', form.value.scheduled_at)
  }

  
  if (form.value.image) {
    formData.append('image', form.value.image)
  }

  axios.post('/blogs', formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  })
    .then(() => {
      closeDialog()
      router.visit(window.location.pathname, { preserveScroll: true })
    })
    .catch(error => {
      console.error('Error:', error)
    })
    .finally(() => {
      loading.value = false
    })
}
</script>

<style scoped>
.v-data-table {
  font-size: 14px;
}

.v-card {
  transition: all 0.3s ease;
}

.v-btn {
  text-transform: none;
  letter-spacing: 0.5px;
}

.v-chip {
  text-transform: none;
  letter-spacing: 0.5px;
}

.v-list-item {
  min-height: 40px;
}

.v-list-item__prepend {
  margin-right: 12px;
}

.blog-dialog-header {
  background: linear-gradient(135deg, #1976D2 0%, #2196F3 100%);
  border-radius: 8px 8px 0 0;
}

.header-icon-wrapper {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 12px;
  padding: 8px;
}

.blog-card {
  border: 1px solid rgba(0, 0, 0, 0.12);
  border-radius: 12px;
  transition: all 0.3s ease;
  margin-bottom: 16px;
}

.blog-card:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.v-text-field, .v-textarea, .v-select {
  border-radius: 8px;
}

.v-card-text {
  padding: 12px !important;
}
</style>
