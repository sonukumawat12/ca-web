<template>
  <AppLayout>
    <v-container fluid class="pa-6">
      <!-- Header Section -->
      <div class="d-flex align-center justify-space-between mb-6">
        <div>
          <h1 class="text-h4 font-weight-bold primary--text mb-2">Team Management</h1>
          <p class="text-subtitle-1 text-medium-emphasis">Manage your team members</p>
        </div>
        <v-btn
          color="primary"
          elevation="2"
          prepend-icon="mdi-plus"
          size="large"
          @click="openDialog()"
        >
          Add Team Member
        </v-btn>
      </div>

      <!-- Main Content Card -->
      <v-card class="rounded-lg" elevation="2">
        <v-card-text class="pa-6">
          <v-data-table
            :headers="headers"
            :items="teamMembers"
            :items-per-page="10"
            class="elevation-0"
            :footer-props="{
              'items-per-page-options': [5, 10, 20, 50],
              'items-per-page-text': 'Rows per page'
            }"
          >
            <!-- Profile Image Column -->
            <template #[`item.profile`]="{ item }">
              <v-avatar size="40" class="my-2">
                <img :src="item.profile" alt="Profile" />
              </v-avatar>
            </template>

            <!-- Name Column -->
            <template #[`item.name`]="{ item }">
              <div class="font-weight-medium">{{ item.name }}</div>
            </template>

            <!-- Position Column -->
            <template #[`item.position`]="{ item }">
              <div class="text-medium-emphasis">{{ item.position }}</div>
            </template>

            <!-- Social Media Column -->
            <template #[`item.social_media`]="{ item }">
              <div class="d-flex gap-2">
                <v-btn
                  v-if="item.social_media.linkedin"
                  icon
                  size="small"
                  color="primary"
                  variant="text"
                  :href="item.social_media.linkedin"
                  target="_blank"
                >
                  <v-icon>mdi-linkedin</v-icon>
                </v-btn>
                <v-btn
                  v-if="item.social_media.twitter"
                  icon
                  size="small"
                  color="info"
                  variant="text"
                  :href="item.social_media.twitter"
                  target="_blank"
                >
                  <v-icon>mdi-twitter</v-icon>
                </v-btn>
                <v-btn
                  v-if="item.social_media.github"
                  icon
                  size="small"
                  color="grey-darken-3"
                  variant="text"
                  :href="item.social_media.github"
                  target="_blank"
                >
                  <v-icon>mdi-github</v-icon>
                </v-btn>
              </div>
            </template>

            <!-- Actions Column -->
            <template #[`item.actions`]="{ item }">
              <div class="d-flex gap-2">
                <v-btn
                  icon
                  size="small"
                  color="primary"
                  variant="text"
                  @click="editMember(item)"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-btn
                  icon
                  size="small"
                  color="error"
                  variant="text"
                  @click="deleteMember(item)"
                >
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
              </div>
            </template>

            <!-- No Data Template -->
            <template #no-data>
              <v-container class="fill-height">
                <v-row align="center" justify="center">
                  <v-col cols="12" sm="8" md="6" lg="4" class="text-center">
                    <v-icon size="64" color="grey-lighten-1" class="mb-4">mdi-account-group</v-icon>
                    <h3 class="text-h6 mb-2">No Team Members Found</h3>
                    <p class="text-body-2 text-medium-emphasis mb-4">Add your first team member to get started</p>
                    <v-btn color="primary" @click="openDialog()">Add Team Member</v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>

      <!-- Add/Edit Team Member Dialog -->
      <v-dialog v-model="dialog" max-width="800px" persistent>
        <v-card class="rounded-lg">
          <!-- Header with Gradient Background -->
          <div class="team-dialog-header">
            <v-card-title class="d-flex align-center pa-6 pb-4">
              <div class="d-flex align-center">
                <div class="header-icon-wrapper">
                  <v-icon size="32" color="white">{{ isEditing ? 'mdi-pencil' : 'mdi-account-plus' }}</v-icon>
                </div>
                <span class="text-h4 font-weight-bold text-white ml-4">{{ isEditing ? 'Edit Team Member' : 'Add Team Member' }}</span>
              </div>
              <v-spacer />
              <v-btn icon variant="text" color="white" @click="closeDialog">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-card-title>
          </div>

          <v-card-text class="pa-6">
            <v-form ref="formRef" @submit.prevent="submitMember">
              <v-row>
                <!-- Left Column -->
                <v-col cols="12" md="6">
                  <!-- Name -->
                  <v-text-field
                    v-model="form.name"
                    label="Full Name"
                    variant="outlined"
                    :rules="[v => !!v || 'Name is required']"
                    required
                  />

                  <!-- Position -->
                  <v-text-field
                    v-model="form.position"
                    label="Position"
                    variant="outlined"
                    :rules="[v => !!v || 'Position is required']"
                    required
                  />

                  <!-- Bio -->
                  <v-textarea
                    v-model="form.bio"
                    label="Bio"
                    variant="outlined"
                    rows="4"
                    :rules="[v => !!v || 'Bio is required']"
                    required
                  />
                </v-col>

                <!-- Right Column -->
                <v-col cols="12" md="6">
                  <!-- Profile Image -->
                  <v-file-input
                    v-model="form.profile"
                    label="Profile Image"
                    variant="outlined"
                    accept="image/*"
                    prepend-icon="mdi-camera"
                    :rules="[
                      v => !v || v.size < 5000000 || 'Image size should be less than 5 MB',
                      v => !v || v.type.startsWith('image/') || 'File must be an image'
                    ]"
                    @change="handleImageUpload"
                  />

                  <!-- Image Preview -->
                  <div v-if="imagePreview" class="mt-4">
                    <v-img
                      :src="imagePreview"
                      max-height="200"
                      cover
                      class="rounded-lg"
                    ></v-img>
                  </div>

                  <!-- Social Media Links -->
                  <v-text-field
                    v-model="form.social_media.linkedin"
                    label="LinkedIn URL"
                    variant="outlined"
                    prepend-icon="mdi-linkedin"
                    class="mt-4"
                  />

                  <v-text-field
                    v-model="form.social_media.twitter"
                    label="Twitter URL"
                    variant="outlined"
                    prepend-icon="mdi-twitter"
                  />

                  <v-text-field
                    v-model="form.social_media.github"
                    label="GitHub URL"
                    variant="outlined"
                    prepend-icon="mdi-github"
                  />
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
              @click="submitMember"
              :loading="loading"
              class="ml-4 px-8"
              elevation="2"
              size="large"
            >
              {{ isEditing ? 'Update Member' : 'Add Member' }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </AppLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import type { DataTableHeader } from 'vuetify'

interface SocialMedia {
  linkedin?: string
  twitter?: string
  github?: string
}

interface TeamMember {
  id: number
  name: string
  position: string
  bio: string
  profile: string
  social_media: SocialMedia
}

interface FormData {
  name: string
  position: string
  bio: string
  profile: File | null
  social_media: SocialMedia
}

const teamMembers = ref<TeamMember[]>([
  {
    id: 1,
    name: 'Rajesh Kumar',
    position: 'Managing Partner',
    bio: 'FCA with over 20 years of experience in audit, taxation, and business advisory services.',
    profile: 'https://i.pravatar.cc/150?img=1',
    social_media: {
      linkedin: 'https://linkedin.com/in/rajeshkumar',
    }
  },
  {
    id: 2,
    name: 'Priya Sharma',
    position: 'Tax Consultant',
    bio: 'CA specializing in direct and indirect taxation, with expertise in international tax planning.',
    profile: 'https://i.pravatar.cc/150?img=2',
    social_media: {
      linkedin: 'https://linkedin.com/in/priyasharma',
    }
  },
  {
    id: 3,
    name: 'Amit Patel',
    position: 'Audit Manager',
    bio: 'CA with 8 years of experience in statutory audits, internal controls, and risk assessment.',
    profile: 'https://i.pravatar.cc/150?img=3',
    social_media: {
      linkedin: 'https://linkedin.com/in/amitpatel',
    }
  },
  {
    id: 4,
    name: 'Neha Gupta',
    position: 'Business Advisory Lead',
    bio: 'CA specializing in business strategy, financial planning, and corporate restructuring.',
    profile: 'https://i.pravatar.cc/150?img=4',
    social_media: {
      linkedin: 'https://linkedin.com/in/nehagupta',
    }
  },
  {
    id: 5,
    name: 'Vikram Singh',
    position: 'Compliance Officer',
    bio: 'CA with expertise in regulatory compliance, corporate governance, and risk management.',
    profile: 'https://i.pravatar.cc/150?img=5',
    social_media: {
      linkedin: 'https://linkedin.com/in/vikramsingh',
    }
  }
])

const headers = ref<readonly DataTableHeader[]>([
  {
    title: 'Profile',
    key: 'profile',
    sortable: false,
    align: 'center'
  },
  {
    title: 'Name',
    key: 'name',
    sortable: true,
    align: 'start'
  },
  {
    title: 'Position',
    key: 'position',
    sortable: true,
    align: 'start'
  },
  {
    title: 'Bio',
    key: 'bio',
    sortable: false,
    align: 'start'
  },
  {
    title: 'Social Media',
    key: 'social_media',
    sortable: false,
    align: 'center'
  },
  {
    title: 'Actions',
    key: 'actions',
    sortable: false,
    align: 'center'
  }
] as const)

const dialog = ref(false)
const loading = ref(false)
const formRef = ref<{ validate: () => boolean } | null>(null)
const isEditing = ref(false)
const imagePreview = ref<string | null>(null)
const editingId = ref<number | null>(null)

const form = ref<FormData>({
  name: '',
  position: '',
  bio: '',
  profile: null,
  social_media: {}
})

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
    form.value.profile = file

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
    name: '',
    position: '',
    bio: '',
    profile: null,
    social_media: {}
  }
  imagePreview.value = null
  isEditing.value = false
  editingId.value = null
}

function editMember(member: TeamMember) {
  isEditing.value = true
  editingId.value = member.id
  form.value = {
    name: member.name,
    position: member.position,
    bio: member.bio,
    profile: null,
    social_media: { ...member.social_media }
  }
  imagePreview.value = member.profile
  dialog.value = true
}

function deleteMember(member: TeamMember) {
  if (confirm('Are you sure you want to delete this team member?')) {
    router.delete(`/teams/${member.id}`, {
      onSuccess: () => {
        // Success message will be handled by the controller
      }
    })
  }
}

function submitMember() {
  if (!formRef.value?.validate()) return

  loading.value = true

  const formData = new FormData()
  formData.append('name', form.value.name)
  formData.append('position', form.value.position)
  formData.append('bio', form.value.bio)
  formData.append('social_media', JSON.stringify(form.value.social_media))

  if (form.value.profile) {
    formData.append('profile', form.value.profile)
  }

  if (isEditing.value) {
    router.put(`/teams/${editingId.value}`, formData, {
      onSuccess: () => {
        closeDialog()
        loading.value = false
      },
      onError: () => {
        loading.value = false
      }
    })
  } else {
    router.post('/teams', formData, {
      onSuccess: () => {
        closeDialog()
        loading.value = false
      },
      onError: () => {
        loading.value = false
      }
    })
  }
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

.team-dialog-header {
  background: linear-gradient(135deg, #1976D2 0%, #2196F3 100%);
  border-radius: 8px 8px 0 0;
}

.header-icon-wrapper {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 12px;
  padding: 8px;
}

.v-text-field, .v-textarea {
  border-radius: 8px;
}
</style>
