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

      <!-- Filters Section -->
      <v-card class="mb-6 rounded-lg" elevation="2">
        <v-card-text class="pa-4">
          <v-row>
            <v-col cols="12" md="3">
              <v-text-field
                v-model="filters.search"
                label="Search blogs"
                prepend-inner-icon="mdi-magnify"
                variant="outlined"
                density="comfortable"
                hide-details
                @input="applyFilters"
              />
            </v-col>
            <v-col cols="12" md="3">
              <v-select
                v-model="filters.category"
                :items="categories"
                label="Category"
                variant="outlined"
                density="comfortable"
                hide-details
                @update:model-value="applyFilters"
              />
            </v-col>
            <v-col cols="12" md="3">
              <v-select
                v-model="filters.status"
                :items="statusOptions"
                label="Status"
                variant="outlined"
                density="comfortable"
                hide-details
                @update:model-value="applyFilters"
              />
            </v-col>
            <v-col cols="12" md="3">
              <v-menu
                v-model="dateMenu"
                :close-on-content-click="false"
                transition="scale-transition"
              >
                <template v-slot:activator="{ props }">
                  <v-text-field
                    v-bind="props"
                    v-model="filters.dateRange"
                    label="Date Range"
                    prepend-inner-icon="mdi-calendar"
                    variant="outlined"
                    density="comfortable"
                    hide-details
                    readonly
                  />
                </template>
                <v-date-picker
                  v-model="filters.dateRange"
                  range
                  @update:model-value="applyFilters"
                />
              </v-menu>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>

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
            <!-- Title Column -->
            <template #item.title="{ item }">
              <div class="d-flex align-center">
                <v-avatar size="40" class="mr-3">
                  <v-img :src="item.image || '/default-blog.jpg'" cover></v-img>
                </v-avatar>
                <div>
                  <div class="font-weight-medium">{{ item.title }}</div>
                  <div class="text-caption text-medium-emphasis">{{ item.category }}</div>
                </div>
              </div>
            </template>

            <!-- Status Column -->
            <template #item.is_published="{ item }">
              <v-chip
                :color="getStatusColor(item)"
                size="small"
                class="font-weight-medium"
                :class="getStatusTextClass(item)"
                variant="tonal"
              >
                <v-icon start size="small" :icon="getStatusIcon(item)"></v-icon>
                {{ getStatusText(item) }}
              </v-chip>
            </template>

            <!-- Published Date Column -->
            <template #item.published_at="{ item }">
              <div class="d-flex align-center">
                <v-icon size="small" class="mr-1 text-medium-emphasis">mdi-calendar</v-icon>
                <span class="text-medium-emphasis">{{ formatDate(item.published_at) }}</span>
              </div>
            </template>

            <!-- Actions Column -->
            <template #item.actions="{ item }">
              <v-menu location="bottom end">
                <template v-slot:activator="{ props }">
                  <v-btn
                    icon
                    variant="text"
                    v-bind="props"
                  >
                    <v-icon>mdi-dots-vertical</v-icon>
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item @click="editBlog(item)">
                    <template v-slot:prepend>
                      <v-icon>mdi-pencil</v-icon>
                    </template>
                    <v-list-item-title>Edit</v-list-item-title>
                  </v-list-item>
                  <v-list-item @click="scheduleBlog(item)">
                    <template v-slot:prepend>
                      <v-icon>mdi-clock-outline</v-icon>
                    </template>
                    <v-list-item-title>Schedule</v-list-item-title>
                  </v-list-item>
                  <v-list-item @click="deleteBlog(item)">
                    <template v-slot:prepend>
                      <v-icon color="error">mdi-delete</v-icon>
                    </template>
                    <v-list-item-title class="text-error">Delete</v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-menu>
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
      <v-dialog v-model="dialog" max-width="900px" persistent>
        <v-card class="rounded-lg">
          <v-card-title class="pa-6 pb-4 d-flex align-center">
            <span class="text-h5 font-weight-bold">{{ isEditing ? 'Edit Blog' : 'Create New Blog' }}</span>
            <v-spacer />
            <v-btn icon @click="closeDialog">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-title>

          <v-card-text class="pa-6">
            <v-form ref="formRef" @submit.prevent="submitBlog">
              <v-row>
                <v-col cols="12" md="8">
                  <v-text-field
                    v-model="form.title"
                    label="Blog Title"
                    variant="outlined"
                    density="comfortable"
                    :rules="[v => !!v || 'Title is required']"
                    required
                  />
                </v-col>
                <v-col cols="12" md="4">
                  <v-text-field
                    v-model="form.category"
                    label="Category"
                    variant="outlined"
                    density="comfortable"
                    :rules="[v => !!v || 'Category is required']"
                    required
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-textarea
                    v-model="form.content"
                    label="Content"
                    variant="outlined"
                    rows="6"
                    auto-grow
                    :rules="[v => !!v || 'Content is required']"
                    required
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" md="6">
                  <v-file-input
                    v-model="form.image"
                    label="Featured Image"
                    variant="outlined"
                    density="comfortable"
                    accept="image/*"
                    prepend-icon="mdi-camera"
                    show-size
                    :rules="[v => !v || v.size < 5000000 || 'Image size should be less than 5 MB']"
                  />
                </v-col>
                <v-col cols="12" md="6">
                  <v-card variant="outlined" class="pa-4">
                    <div class="text-subtitle-1 font-weight-medium mb-2">Publication Settings</div>
                    <v-switch
                      v-model="form.is_published"
                      color="success"
                      label="Publish immediately"
                      hide-details
                      class="mb-4"
                    />
                    <v-menu
                      v-if="!form.is_published"
                      v-model="scheduleMenu"
                      :close-on-content-click="false"
                      transition="scale-transition"
                    >
                      <template v-slot:activator="{ props }">
                        <v-text-field
                          v-bind="props"
                          v-model="form.scheduled_at"
                          label="Schedule Publication"
                          prepend-inner-icon="mdi-clock-outline"
                          variant="outlined"
                          density="comfortable"
                          readonly
                        />
                      </template>
                      <v-date-picker
                        v-model="form.scheduled_at"
                        :min="new Date().toISOString().substr(0, 10)"
                      />
                    </v-menu>
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
            >
              Cancel
            </v-btn>
            <v-btn
              color="primary"
              @click="submitBlog"
              :loading="loading"
              class="ml-4"
            >
              {{ isEditing ? 'Update Blog' : 'Create Blog' }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <!-- Schedule Dialog -->
      <v-dialog v-model="scheduleDialog" max-width="500px">
        <v-card class="rounded-lg">
          <v-card-title class="pa-6 pb-4">
            <span class="text-h5 font-weight-bold">Schedule Blog Post</span>
          </v-card-title>

          <v-card-text class="pa-6">
            <v-form ref="scheduleFormRef">
              <v-menu
                v-model="scheduleDateMenu"
                :close-on-content-click="false"
                transition="scale-transition"
              >
                <template v-slot:activator="{ props }">
                  <v-text-field
                    v-bind="props"
                    v-model="scheduleForm.date"
                    label="Publication Date"
                    prepend-inner-icon="mdi-calendar"
                    variant="outlined"
                    density="comfortable"
                    :rules="[v => !!v || 'Date is required']"
                    required
                    readonly
                  />
                </template>
                <v-date-picker
                  v-model="scheduleForm.date"
                  :min="new Date().toISOString().substr(0, 10)"
                />
              </v-menu>

              <v-text-field
                v-model="scheduleForm.time"
                label="Publication Time"
                type="time"
                variant="outlined"
                density="comfortable"
                :rules="[v => !!v || 'Time is required']"
                required
                class="mt-4"
              />
            </v-form>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions class="pa-6">
            <v-spacer />
            <v-btn
              variant="outlined"
              color="grey-darken-1"
              @click="scheduleDialog = false"
            >
              Cancel
            </v-btn>
            <v-btn
              color="primary"
              @click="submitSchedule"
              :loading="loading"
              class="ml-4"
            >
              Schedule
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { usePage, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const blogs = ref([
  {
    id: 1,
    title: 'Getting Started with Vue.js 3',
    category: 'Web Development',
    is_published: true,
    published_at: '2024-03-15',
    content: 'Learn the basics of Vue.js 3 and its composition API...',
    image: 'https://picsum.photos/200/200?random=1'
  },
  {
    id: 2,
    title: 'Advanced CSS Techniques',
    category: 'Frontend',
    is_published: true,
    published_at: '2024-03-14',
    content: 'Explore modern CSS features and best practices...',
    image: 'https://picsum.photos/200/200?random=2'
  },
  {
    id: 3,
    title: 'Building REST APIs with Laravel',
    category: 'Backend',
    is_published: false,
    published_at: null,
    scheduled_at: '2024-03-20',
    content: 'A comprehensive guide to creating RESTful APIs...',
    image: 'https://picsum.photos/200/200?random=3'
  },
  {
    id: 4,
    title: 'State Management in Vue',
    category: 'Web Development',
    is_published: true,
    published_at: '2024-03-13',
    content: 'Understanding Vuex and Pinia for state management...',
    image: 'https://picsum.photos/200/200?random=4'
  },
  {
    id: 5,
    title: 'Responsive Design Patterns',
    category: 'UI/UX',
    is_published: true,
    published_at: '2024-03-12',
    content: 'Best practices for creating responsive layouts...',
    image: 'https://picsum.photos/200/200?random=5'
  }
])

const user = computed(() => usePage().props.user)

const dialog = ref(false)
const scheduleDialog = ref(false)
const formRef = ref(null)
const scheduleFormRef = ref(null)
const loading = ref(false)
const isEditing = ref(false)
const dateMenu = ref(false)
const scheduleMenu = ref(false)
const scheduleDateMenu = ref(false)

const categories = ['Web Development', 'Frontend', 'Backend', 'UI/UX']
const statusOptions = [
  { title: 'All', value: 'all' },
  { title: 'Published', value: 'published' },
  { title: 'Draft', value: 'draft' },
  { title: 'Scheduled', value: 'scheduled' }
]

const filters = ref({
  search: '',
  category: '',
  status: 'all',
  dateRange: []
})

const form = useForm({
  title: '',
  category: '',
  is_published: false,
  image: null,
  content: '',
  scheduled_at: null
})

const scheduleForm = ref({
  date: '',
  time: ''
})

const headers = [
  { text: 'Blog Post', value: 'title', sortable: false },
  { text: 'Status', value: 'is_published', align: 'center' },
  { text: 'Published Date', value: 'published_at', align: 'center' },
  { text: 'Actions', value: 'actions', align: 'center', sortable: false },
]

const filteredBlogs = computed(() => {
  return blogs.value.filter(blog => {
    const matchesSearch = blog.title.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                         blog.content.toLowerCase().includes(filters.value.search.toLowerCase())
    const matchesCategory = !filters.value.category || blog.category === filters.value.category
    const matchesStatus = filters.value.status === 'all' ||
                         (filters.value.status === 'published' && blog.is_published) ||
                         (filters.value.status === 'draft' && !blog.is_published && !blog.scheduled_at) ||
                         (filters.value.status === 'scheduled' && blog.scheduled_at)
    const matchesDate = !filters.value.dateRange.length ||
                       (blog.published_at && new Date(blog.published_at) >= new Date(filters.value.dateRange[0]) &&
                        new Date(blog.published_at) <= new Date(filters.value.dateRange[1]))
    return matchesSearch && matchesCategory && matchesStatus && matchesDate
  })
})

function getStatusColor(item) {
  if (item.scheduled_at) return 'info'
  return item.is_published ? 'success' : 'warning'
}

function getStatusTextClass(item) {
  if (item.scheduled_at) return 'info--text'
  return item.is_published ? 'success--text' : 'warning--text'
}

function getStatusIcon(item) {
  if (item.scheduled_at) return 'mdi-clock-outline'
  return item.is_published ? 'mdi-check-circle' : 'mdi-clock-outline'
}

function getStatusText(item) {
  if (item.scheduled_at) return 'Scheduled'
  return item.is_published ? 'Published' : 'Draft'
}

function formatDate(date) {
  if (!date) return '-'
  return new Date(date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}

function openDialog() {
  isEditing.value = false
  resetForm()
  dialog.value = true
}

function closeDialog() {
  dialog.value = false
  resetForm()
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
  isEditing.value = false
}

function editBlog(item) {
  isEditing.value = true
  form.value = { ...item }
  dialog.value = true
}

function scheduleBlog(item) {
  scheduleForm.value = {
    date: '',
    time: ''
  }
  scheduleDialog.value = true
}

function deleteBlog(item) {
  if (confirm('Are you sure you want to delete this blog post?')) {
    router.delete(`/blogs/${item.id}`)
  }
}

function applyFilters() {
  // Filters are automatically applied through the computed property
}

function submitBlog() {
  // Create form data
  const formData = new FormData()
  formData.append('title', form.title)
  formData.append('content', form.content)
  formData.append('category', form.category)
  formData.append('is_published', form.is_published ? 1 : 0)
  formData.append('user_id', user.value.id)
  formData.append('scheduled_at', form.scheduled_at)
    
  
  // Send POST request
  axios.post('/blogs', formData)
      .then(response => {
          // Close dialog after successful submission
          closeDialog()
          // Refresh the page to show new blog
          window.location.reload()
      })
      .catch(error => {
          console.error('Error:', error)
      })
}

function submitSchedule() {
  if (!scheduleFormRef.value.validate()) return

  loading.value = true
  const scheduledDateTime = `${scheduleForm.value.date}T${scheduleForm.value.time}`
  
  router.put(`/blogs/${form.value.id}/schedule`, {
    scheduled_at: scheduledDateTime
  }, {
    onSuccess: () => {
      scheduleDialog.value = false
    },
    onFinish: () => {
      loading.value = false
    }
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
</style>
