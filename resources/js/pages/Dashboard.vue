<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/dashboard' },
];

const page = usePage();
const authUser = page.props.authUser;
const blogs = page.props.blogs;


const stats = [
  {
    title: 'Total Blogs',
    value: blogs.length,
    color: 'indigo',
    icon: 'mdi-post',
    trend: '+5 this month',
    description: 'Active blog posts',
    change: '+12%',
    changeType: 'increase'
  },
  {
    title: 'Team Members',
    value: 12,
    color: 'teal',
    icon: 'mdi-account-group',
    trend: '+2 new hires',
    description: 'Active team members',
    change: '+8%',
    changeType: 'increase'
  },
  {
    title: 'Total Leads',
    value: 156,
    color: 'orange',
    icon: 'mdi-account-multiple',
    trend: '+23 this week',
    description: 'Potential customers',
    change: '+15%',
    changeType: 'increase'
  },
];

const recentBlogs = [
  {
    title: 'Getting Started with Web Development',
    author: 'Sarah Johnson',
    date: '2 days ago',
    views: 245,
    category: 'Development',
    readTime: '5 min read',
    image: 'https://picsum.photos/200/100?random=1'
  },
  {
    title: 'Best Practices for UI Design',
    author: 'Mike Chen',
    date: '4 days ago',
    views: 189,
    category: 'Design',
    readTime: '8 min read',
    image: 'https://picsum.photos/200/100?random=2'
  },
  {
    title: 'SEO Tips for 2024',
    author: 'Emma Davis',
    date: '1 week ago',
    views: 312,
    category: 'Marketing',
    readTime: '6 min read',
    image: 'https://picsum.photos/200/100?random=3'
  }
];

const teamMembers = [
  {
    name: 'John Smith',
    role: 'Lead Developer',
    avatar: 'JS',
    status: 'Online',
    projects: 4,
    skills: ['Vue.js', 'TypeScript', 'Node.js'],
    availability: 'Full-time'
  },
  {
    name: 'Lisa Wong',
    role: 'UI Designer',
    avatar: 'LW',
    status: 'Away',
    projects: 3,
    skills: ['Figma', 'UI/UX', 'Prototyping'],
    availability: 'Full-time'
  },
  {
    name: 'David Kim',
    role: 'Content Writer',
    avatar: 'DK',
    status: 'Online',
    projects: 5,
    skills: ['Content', 'SEO', 'Research'],
    availability: 'Contract'
  }
];

const recentLeads = [
  {
    company: 'Tech Solutions Inc',
    contact: 'Robert Brown',
    email: 'robert@techsolutions.com',
    status: 'New',
    date: 'Today',
    source: 'Website',
    budget: '$50k-100k'
  },
  {
    company: 'Digital Marketing Pro',
    contact: 'Maria Garcia',
    email: 'maria@digitalpro.com',
    status: 'Contacted',
    date: 'Yesterday',
    source: 'LinkedIn',
    budget: '$25k-50k'
  },
  {
    company: 'Creative Studios',
    contact: 'Alex Turner',
    email: 'alex@creativestudios.com',
    status: 'Qualified',
    date: '2 days ago',
    source: 'Referral',
    budget: '$100k+'
  }
];
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <v-container fluid class="py-8">
      <!-- Welcome Section with Quick Actions -->
      <v-row class="mb-8">
        <v-col cols="12" md="8">
          <div class="text-h4 font-weight-bold mb-2">Welcome back, Admin!</div>
          <div class="text-subtitle-1 text-grey-darken-1">Here's what's happening with your content and team today.</div>
        </v-col>
        <v-col cols="12" md="4" class="d-flex align-center justify-end">
          <v-btn
            color="primary"
            prepend-icon="mdi-plus"
            class="text-none mr-2"
            elevation="0"
          >
            New Post
          </v-btn>
          <v-btn
            color="primary"
            variant="outlined"
            prepend-icon="mdi-account-plus"
            class="text-none"
            elevation="0"
          >
            Add Lead
          </v-btn>
        </v-col>
      </v-row>

      <!-- Quick Stats Cards -->
      <v-row dense>
        <v-col v-for="(item, index) in stats" :key="index" cols="12" md="4">
          <v-card class="d-flex flex-column pa-6 rounded-lg" :color="`${item.color}-lighten-5`" elevation="0">
            <div class="d-flex align-center mb-4">
              <v-avatar size="56" :color="item.color" class="elevation-2">
                <v-icon size="28" color="white">{{ item.icon }}</v-icon>
              </v-avatar>
              <div class="ml-6">
                <div class="text-subtitle-2 font-weight-medium text-grey-darken-2">{{ item.title }}</div>
                <div class="text-h4 font-weight-bold">{{ item.value }}</div>
              </div>
            </div>
            <div class="d-flex align-center">
              <v-chip
                size="small"
                :color="item.color"
                variant="flat"
                class="mr-2"
              >
                {{ item.trend }}
              </v-chip>
              <span class="text-caption text-grey-darken-1">{{ item.description }}</span>
              <v-spacer></v-spacer>
              <div class="d-flex align-center">
                <v-icon
                  :color="item.changeType === 'increase' ? 'success' : 'error'"
                  size="small"
                  class="mr-1"
                >
                  {{ item.changeType === 'increase' ? 'mdi-trending-up' : 'mdi-trending-down' }}
                </v-icon>
                <span :class="`text-caption font-weight-medium ${item.changeType === 'increase' ? 'text-success' : 'text-error'}`">
                  {{ item.change }}
                </span>
              </div>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <!-- Main Content Area -->
      <v-row class="mt-8" dense>
        <!-- Recent Blogs -->
        <v-col cols="12" md="6">
          <v-card elevation="0" class="rounded-lg">
            <v-card-title class="d-flex align-center pa-6 pb-2">
              <span class="text-h6 font-weight-bold">Recent Blog Posts</span>
              <v-spacer></v-spacer>
              <v-btn
                variant="text"
                color="indigo"
                prepend-icon="mdi-plus"
                class="text-none"
              >
                New Post
              </v-btn>
            </v-card-title>
            <v-list class="pa-2">
              <v-list-item
                v-for="blog in recentBlogs"
                :key="blog.title"
                class="mb-2 rounded-lg"
                color="indigo-lighten-5"
              >
                <template v-slot:prepend>
                  <v-img
                    :src="blog.image"
                    width="80"
                    height="60"
                    class="rounded-lg mr-4"
                    cover
                  ></v-img>
                </template>
                <v-list-item-title class="font-weight-medium mb-1">{{ blog.title }}</v-list-item-title>
                <v-list-item-subtitle class="d-flex align-center flex-wrap">
                  <span class="mr-4 d-flex align-center">
                    <v-avatar size="24" color="grey-lighten-3" class="mr-2">
                      <span class="text-caption">{{ blog.author.charAt(0) }}</span>
                    </v-avatar>
                    {{ blog.author }}
                  </span>
                  <span class="mr-4 d-flex align-center">
                    <v-icon size="small" class="mr-1">mdi-eye</v-icon>
                    {{ blog.views }}
                  </span>
                  <v-chip
                    size="x-small"
                    color="indigo"
                    variant="flat"
                    class="mr-2"
                  >
                    {{ blog.category }}
                  </v-chip>
                  <span class="text-caption text-grey-darken-1 mr-2">{{ blog.readTime }}</span>
                  <span class="text-caption text-grey-darken-1">{{ blog.date }}</span>
                </v-list-item-subtitle>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>

        <!-- Team Members -->
        <v-col cols="12" md="6">
          <v-card elevation="0" class="rounded-lg">
            <v-card-title class="d-flex align-center pa-6 pb-2">
              <span class="text-h6 font-weight-bold">Team Members</span>
              <v-spacer></v-spacer>
              <v-btn
                variant="text"
                color="teal"
                prepend-icon="mdi-account-plus"
                class="text-none"
              >
                Add Member
              </v-btn>
            </v-card-title>
            <v-list class="pa-2">
              <v-list-item
                v-for="member in teamMembers"
                :key="member.name"
                class="mb-2 rounded-lg"
                color="teal-lighten-5"
              >
                <template v-slot:prepend>
                  <v-avatar :color="member.status === 'Online' ? 'teal' : 'grey'" size="40">
                    <span class="text-white">{{ member.avatar }}</span>
                  </v-avatar>
                </template>
                <v-list-item-title class="font-weight-medium mb-1">{{ member.name }}</v-list-item-title>
                <v-list-item-subtitle class="d-flex align-center flex-wrap">
                  <span class="mr-4">{{ member.role }}</span>
                  <v-chip
                    size="x-small"
                    :color="member.status === 'Online' ? 'teal' : 'grey'"
                    variant="flat"
                    class="mr-2"
                  >
                    {{ member.status }}
                  </v-chip>
                  <v-chip
                    size="x-small"
                    color="primary"
                    variant="flat"
                    class="mr-2"
                  >
                    {{ member.availability }}
                  </v-chip>
                  <div class="d-flex align-center mt-1">
                    <v-chip
                      v-for="skill in member.skills"
                      :key="skill"
                      size="x-small"
                      color="grey"
                      variant="flat"
                      class="mr-1"
                    >
                      {{ skill }}
                    </v-chip>
                  </div>
                </v-list-item-subtitle>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>

        <!-- Recent Leads -->
        <v-col cols="12">
          <v-card elevation="0" class="rounded-lg">
            <v-card-title class="d-flex align-center pa-6 pb-2">
              <span class="text-h6 font-weight-bold">Recent Leads</span>
              <v-spacer></v-spacer>
              <v-btn
                variant="text"
                color="orange"
                prepend-icon="mdi-account-plus"
                class="text-none"
              >
                Add Lead
              </v-btn>
            </v-card-title>
            <v-data-table
              :headers="[
                { title: 'Company', key: 'company' },
                { title: 'Contact', key: 'contact' },
                { title: 'Email', key: 'email' },
                { title: 'Source', key: 'source' },
                { title: 'Budget', key: 'budget' },
                { title: 'Status', key: 'status' },
                { title: 'Date', key: 'date' },
              ]"
              :items="recentLeads"
              hide-default-footer
              class="elevation-0"
              density="comfortable"
            >
              <template v-slot:[`item.status`]="{ item }">
                <v-chip
                  size="small"
                  :color="item.status === 'New' ? 'orange' : item.status === 'Contacted' ? 'blue' : 'green'"
                  variant="flat"
                >
                  {{ item.status }}
                </v-chip>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </AppLayout>
</template>
