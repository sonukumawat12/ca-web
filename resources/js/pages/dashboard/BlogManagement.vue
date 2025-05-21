<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import axios from 'axios';

interface Blog {
  id: number;
  title: string;
  excerpt: string;
  content: string;
  category: string;
  image: string | null;
  tags: string[];
  is_published: boolean;
  published_at: string | null;
}

const blogs = ref<Blog[]>([]);
const showCreateModal = ref(false);
const showEditModal = ref(false);
const selectedBlog = ref<Blog | null>(null);
const isLoading = ref(false);
const showNotification = ref(false);
const notificationMessage = ref('');
const notificationType = ref<'success' | 'error'>('success');

const form = useForm({
  title: '',
  excerpt: '',
  content: '',
  category: '',
  image: null as File | null,
  tags: [] as string[],
  is_published: false
});

const categories = [
  'Taxation',
  'Tax Planning',
  'Technology',
  'Startup',
  'Audit',
  'Finance'
];

const showSuccessNotification = (message: string) => {
  notificationMessage.value = message;
  notificationType.value = 'success';
  showNotification.value = true;
  setTimeout(() => {
    showNotification.value = false;
  }, 3000);
};

const showErrorNotification = (message: string) => {
  notificationMessage.value = message;
  notificationType.value = 'error';
  showNotification.value = true;
  setTimeout(() => {
    showNotification.value = false;
  }, 3000);
};

const validateForm = () => {
  if (!form.title.trim()) {
    showErrorNotification('Title is required');
    return false;
  }
  if (!form.excerpt.trim()) {
    showErrorNotification('Excerpt is required');
    return false;
  }
  if (!form.content.trim()) {
    showErrorNotification('Content is required');
    return false;
  }
  if (!form.category) {
    showErrorNotification('Please select a category');
    return false;
  }
  return true;
};

const fetchBlogs = async () => {
  try {
    const response = await axios.get('/api/blogs');
    blogs.value = response.data.data;
  } catch (error) {
    console.error('Failed to fetch blogs:', error);
    showErrorNotification('Failed to fetch blogs');
  }
};

const handleImageUpload = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    const file = target.files[0];
    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
      showErrorNotification('Image size should be less than 5MB');
      return;
    }
    // Validate file type
    if (!file.type.startsWith('image/')) {
      showErrorNotification('Please upload an image file');
      return;
    }
    form.image = file;
  }
};

const createBlog = async () => {
  if (!validateForm()) return;

  isLoading.value = true;
  try {
    const formData = new FormData();
    Object.entries(form).forEach(([key, value]) => {
      if (key === 'tags') {
        formData.append(key, JSON.stringify(value));
      } else if (value !== null) {
        formData.append(key, value);
      }
    });

    await axios.post('/api/blogs', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });

    showCreateModal.value = false;
    form.reset();
    fetchBlogs();
    showSuccessNotification('Blog post created successfully');
  } catch (error) {
    console.error('Failed to create blog:', error);
    showErrorNotification('Failed to create blog post');
  } finally {
    isLoading.value = false;
  }
};

const editBlog = async () => {
  if (!selectedBlog.value) return;

  try {
    const formData = new FormData();
    Object.entries(form).forEach(([key, value]) => {
      if (key === 'tags') {
        formData.append(key, JSON.stringify(value));
      } else if (value !== null) {
        formData.append(key, value);
      }
    });

    await axios.post(`/api/blogs/${selectedBlog.value.id}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });

    showEditModal.value = false;
    form.reset();
    fetchBlogs();
  } catch (error) {
    console.error('Failed to update blog:', error);
  }
};

const deleteBlog = async (blog: Blog) => {
  if (!confirm('Are you sure you want to delete this blog?')) return;

  try {
    await axios.delete(`/api/blogs/${blog.id}`);
    fetchBlogs();
  } catch (error) {
    console.error('Failed to delete blog:', error);
  }
};

const openEditModal = (blog: Blog) => {
  selectedBlog.value = blog;
  form.title = blog.title;
  form.excerpt = blog.excerpt;
  form.content = blog.content;
  form.category = blog.category;
  form.tags = blog.tags || [];
  form.is_published = !!blog.is_published;
  showEditModal.value = true;
};

onMounted(() => {
  fetchBlogs();
});
</script>

<template>
  <AppLayout>
    <template #header>
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-3xl font-bold text-gray-900">Blog Management</h2>
          <p class="mt-1 text-sm text-gray-500">Create and manage your blog content</p>
        </div>
        <button
          @click="showCreateModal = true"
          class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4"/>
          </svg>
          Create New Post
        </button>
      </div>
    </template>

    <!-- Notification -->
    <div
      v-if="showNotification"
      :class="[
        'fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300',
        notificationType === 'success' ? 'bg-green-500' : 'bg-red-500',
        'text-white'
      ]"
    >
      {{ notificationMessage }}
    </div>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
          <div class="p-8">
            <!-- Blog List -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr class="bg-gray-50">
                    <th scope="col" class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase">
                      Blog Post
                    </th>
                    <th scope="col" class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase">
                      Category
                    </th>
                    <th scope="col" class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase">
                      Status
                    </th>
                    <th scope="col" class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="blog in blogs" :key="blog.id" class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-5">
                      <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 overflow-hidden rounded-lg">
                          <img
                            v-if="blog.image"
                            :src="blog.image"
                            class="object-cover w-full h-full"
                            alt="Blog thumbnail"
                          />
                          <div v-else class="flex items-center justify-center w-full h-full bg-gray-100">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                          </div>
                        </div>
                        <div>
                          <h3 class="text-sm font-medium text-gray-900">{{ blog.title }}</h3>
                          <p class="text-sm text-gray-500 line-clamp-1">{{ blog.excerpt }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-5">
                      <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-indigo-50 text-indigo-700">
                        {{ blog.category }}
                      </span>
                    </td>
                    <td class="px-6 py-5">
                      <span
                        :class="[
                          blog.is_published
                            ? 'bg-green-50 text-green-700 ring-green-600/20'
                            : 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
                          'inline-flex items-center px-3 py-1 text-sm font-medium rounded-full ring-1 ring-inset'
                        ]"
                      >
                        {{ blog.is_published ? 'Published' : 'Draft' }}
                      </span>
                    </td>
                    <td class="px-6 py-5">
                      <div class="flex items-center gap-3">
                        <button
                          @click="openEditModal(blog)"
                          class="p-2 text-gray-600 transition-colors duration-200 rounded-lg hover:bg-indigo-50 hover:text-indigo-600"
                        >
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.071-6.071a2 2 0 112.828 2.828L11.828 15.828a4 4 0 01-1.414.828l-4.243 1.414 1.414-4.243a4 4 0 01.828-1.414z" />
                          </svg>
                        </button>
                        <button
                          @click="deleteBlog(blog)"
                          class="p-2 text-gray-600 transition-colors duration-200 rounded-lg hover:bg-red-50 hover:text-red-600"
                        >
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Create Modal -->
    <div v-if="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
        </div>

        <div class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-semibold text-gray-900">Create New Blog Post</h3>
            <button
              @click="showCreateModal = false"
              class="text-gray-400 hover:text-gray-500"
              :disabled="isLoading"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <form @submit.prevent="createBlog" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input
                  v-model="form.title"
                  type="text"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  required
                />
              </div>

              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Excerpt</label>
                <textarea
                  v-model="form.excerpt"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  rows="3"
                  required
                ></textarea>
              </div>

              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Content</label>
                <textarea
                  v-model="form.content"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  rows="6"
                  required
                ></textarea>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select
                  v-model="form.category"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  required
                >
                  <option v-for="category in categories" :key="category" :value="category">
                    {{ category }}
                  </option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <div class="flex items-center justify-center w-full mt-1">
                  <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                      <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                      </svg>
                      <p class="mb-2 text-sm text-gray-500">
                        <span class="font-semibold">Click to upload</span> or drag and drop
                      </p>
                    </div>
                    <input
                      type="file"
                      @change="handleImageUpload"
                      class="hidden"
                      accept="image/*"
                    />
                  </label>
                </div>
              </div>

              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Tags</label>
                <input
                  v-model="form.tags"
                  type="text"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  placeholder="Enter tags separated by commas"
                />
              </div>

              <div class="sm:col-span-2">
                <label class="flex items-center">
                  <input
                    v-model="form.is_published"
                    type="checkbox"
                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                  />
                  <span class="ml-2 text-sm text-gray-700">Publish immediately</span>
                </label>
              </div>
            </div>

            <div class="flex justify-end gap-4 mt-8">
              <button
                type="button"
                @click="showCreateModal = false"
                class="px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                :disabled="isLoading"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-6 py-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="isLoading"
              >
                <span v-if="isLoading" class="flex items-center">
                  <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Creating...
                </span>
                <span v-else>Create Post</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div v-if="showEditModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
        </div>

        <div class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-semibold text-gray-900">Edit Blog Post</h3>
            <button
              @click="showEditModal = false"
              class="text-gray-400 hover:text-gray-500"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <form @submit.prevent="editBlog" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input
                  v-model="form.title"
                  type="text"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  required
                />
              </div>

              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Excerpt</label>
                <textarea
                  v-model="form.excerpt"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  rows="3"
                  required
                ></textarea>
              </div>

              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Content</label>
                <textarea
                  v-model="form.content"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  rows="6"
                  required
                ></textarea>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select
                  v-model="form.category"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  required
                >
                  <option v-for="category in categories" :key="category" :value="category">
                    {{ category }}
                  </option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <div class="flex items-center justify-center w-full mt-1">
                  <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div v-if="!selectedBlog?.image" class="flex flex-col items-center justify-center pt-5 pb-6">
                      <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                      </svg>
                      <p class="mb-2 text-sm text-gray-500">
                        <span class="font-semibold">Click to upload</span> or drag and drop
                      </p>
                    </div>
                    <img
                      v-else
                      :src="selectedBlog.image"
                      class="object-cover w-full h-full rounded-lg"
                      alt="Current blog image"
                    />
                    <input
                      type="file"
                      @change="handleImageUpload"
                      class="hidden"
                      accept="image/*"
                    />
                  </label>
                </div>
              </div>

              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Tags</label>
                <input
                  v-model="form.tags"
                  type="text"
                  class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  placeholder="Enter tags separated by commas"
                />
              </div>

              <div class="sm:col-span-2">
                <label class="flex items-center">
                  <input
                    v-model="form.is_published"
                    type="checkbox"
                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                  />
                  <span class="ml-2 text-sm text-gray-700">Published</span>
                </label>
              </div>
            </div>

            <div class="flex justify-end gap-4 mt-8">
              <button
                type="button"
                @click="showEditModal = false"
                class="px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="px-6 py-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Update Post
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
