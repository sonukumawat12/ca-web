<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/dashboard' },
];

const page = usePage();
const authUser = page.props.authUser as { name: string };
const blogs = page.props.blogs as Array<{
  id: number;
  title: string;
  excerpt: string;
  category: string;
  image?: string;
  view_count: number;
  total_read_time: number;
  created_at: string;
}>;

interface Blog {
  id: number;
  title: string;
  excerpt: string;
  category: string;
  image?: string;
  author: string;
  views: number;
  readTime: string;
  date: string;
}

const recentBlogs = computed(() => {
  return blogs.map(blog => ({
    id: blog.id,
    title: blog.title,
    excerpt: blog.excerpt,
    category: blog.category,
    image: blog.image || 'https://picsum.photos/seed/blog/800/600',
    author: authUser.name,
    views: blog.view_count || 0,
    readTime: `${blog.total_read_time || 5} min read`,
    date: new Date(blog.created_at).toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    })
  }));
});

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

const capitalizeFirst = (str: string) => {
  if (!str) return '';
  return str.split(' ')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
    .join(' ');
}
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <v-container fluid class="pa-4">
      <!-- Top Section with Welcome and Quick Stats -->
      <v-row>
        <!-- Welcome Card -->
        <v-col cols="12" md="4">
          <v-card class="welcome-card pa-4 rounded-xl">
            <div class="d-flex align-center mb-4">
              <v-avatar size="56" class="mr-3 gradient-avatar">
                <span class="text-h5 text-white">{{ authUser.name.charAt(0) }}</span>
              </v-avatar>
              <div>
                <div class="text-h5 font-weight-bold text-white">Welcome back,</div>
                <div class="text-h6 text-white">{{ capitalizeFirst(authUser.name) }}</div>
              </div>
            </div>
            <v-divider class="mb-4" color="rgba(255,255,255,0.2)"></v-divider>
            <div class="d-flex gap-2">
              <v-btn
                color="white"
                variant="flat"
                prepend-icon="mdi-plus"
                class="text-none"
                size="small"
              >
                New Post
              </v-btn>
              <v-btn
                color="white"
                variant="outlined"
                prepend-icon="mdi-bell"
                class="text-none"
                size="small"
              >
                Notifications
              </v-btn>
            </div>
          </v-card>
        </v-col>

        <!-- Quick Stats -->
        <v-col cols="12" md="8">
          <v-row dense>
            <v-col v-for="(item, index) in stats" :key="index" cols="12" sm="6" md="4">
              <v-card class="stat-card pa-4 rounded-xl" :class="`${item.color}-lighten-5`">
                <div class="d-flex align-center">
                  <div class="stat-icon mr-3" :class="item.color">
                    <v-icon :color="item.color">{{ item.icon }}</v-icon>
                  </div>
                  <div>
                    <div class="text-subtitle-2 font-weight-medium text-grey-darken-2">{{ item.title }}</div>
                    <div class="text-h5 font-weight-bold">{{ item.value }}</div>
                  </div>
                </div>
                <div class="d-flex align-center mt-3">
                  <v-chip
                    size="x-small"
                    :color="item.color"
                    variant="flat"
                    class="mr-2"
                  >
                    {{ item.trend }}
                  </v-chip>
                  <span class="text-caption text-grey-darken-1">{{ item.description }}</span>
                </div>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>

      <!-- Main Content Area -->
      <v-row class="mt-4">
        <!-- Recent Blogs -->
        <v-col cols="12" lg="8">
          <v-card class="content-card rounded-xl">
            <v-card-title class="d-flex align-center pa-4">
              <div class="d-flex align-center">
                <div class="section-icon mr-3">
                  <v-icon color="white">mdi-post</v-icon>
                </div>
                <span class="text-h6 font-weight-bold">Recent Blogs</span>
              </div>
              <v-spacer></v-spacer>
              <v-btn
                variant="flat"
                color="primary"
                class="text-none"
                prepend-icon="mdi-plus"
                size="small"
              >
                New Blog
              </v-btn>
            </v-card-title>
            <v-divider></v-divider>
            <v-list class="pa-2">
              <v-list-item
                v-for="blog in recentBlogs"
                :key="blog.id"
                class="blog-item mb-2 rounded-lg"
                hover
              >
                <template v-slot:prepend>
                  <v-img
                    :src="blog.image"
                    width="100"
                    height="60"
                    class="rounded-lg mr-3"
                    cover
                  ></v-img>
                </template>
                <v-list-item-title class="text-subtitle-1 font-weight-medium mb-1">{{ blog.title }}</v-list-item-title>
                <v-list-item-subtitle class="d-flex align-center flex-wrap">
                  <div class="d-flex align-center mr-4">
                    <v-avatar size="24" color="primary" class="mr-1">
                      <span class="text-caption text-white">{{ blog.author.charAt(0) }}</span>
                    </v-avatar>
                    <span class="text-caption">{{ capitalizeFirst(blog.author) }}</span>
                  </div>
                  <div class="d-flex align-center mr-4">
                    <v-icon size="small" class="mr-1">mdi-eye</v-icon>
                    <span class="text-caption">{{ blog.views }}</span>
                  </div>
                  <v-chip
                    size="x-small"
                    color="primary"
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
        <v-col cols="12" lg="4">
          <v-card class="content-card rounded-xl">
            <v-card-title class="d-flex align-center pa-4">
              <div class="d-flex align-center">
                <div class="section-icon mr-3">
                  <v-icon color="white">mdi-account-group</v-icon>
                </div>
                <span class="text-h6 font-weight-bold">Team Members</span>
              </div>
              <v-spacer></v-spacer>
              <v-btn
                variant="flat"
                color="primary"
                class="text-none"
                prepend-icon="mdi-account-plus"
                size="small"
              >
                Add Member
              </v-btn>
            </v-card-title>
            <v-divider></v-divider>
            <v-list class="pa-2">
              <v-list-item
                v-for="member in teamMembers"
                :key="member.name"
                class="team-item mb-2 rounded-lg"
                hover
              >
                <template v-slot:prepend>
                  <v-avatar :color="member.status === 'Online' ? 'success' : 'grey'" size="40">
                    <span class="text-white text-subtitle-2">{{ member.avatar }}</span>
                  </v-avatar>
                </template>
                <v-list-item-title class="text-subtitle-1 font-weight-medium mb-1">{{ member.name }}</v-list-item-title>
                <v-list-item-subtitle class="d-flex align-center flex-wrap">
                  <span class="text-caption mr-3">{{ member.role }}</span>
                  <v-chip
                    size="x-small"
                    :color="member.status === 'Online' ? 'success' : 'grey'"
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
                </v-list-item-subtitle>
                <template v-slot:append>
                  <div class="d-flex">
                    <v-chip
                      v-for="skill in member.skills"
                      :key="skill"
                      size="x-small"
                      color="grey"
                      variant="flat"
                      class="ml-1"
                    >
                      {{ skill }}
                    </v-chip>
                  </div>
                </template>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>

        <!-- Recent Leads -->
        <v-col cols="12">
          <v-card class="content-card rounded-xl">
            <v-card-title class="d-flex align-center pa-4">
              <div class="d-flex align-center">
                <div class="section-icon mr-3">
                  <v-icon color="white">mdi-account-multiple</v-icon>
                </div>
                <span class="text-h6 font-weight-bold">Recent Leads</span>
              </div>
              <v-spacer></v-spacer>
              <v-btn
                variant="flat"
                color="primary"
                class="text-none"
                prepend-icon="mdi-account-plus"
                size="small"
              >
                Add Lead
              </v-btn>
            </v-card-title>
            <v-divider></v-divider>
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
              density="compact"
            >
              <template v-slot:[`item.status`]="{ item }">
                <v-chip
                  size="x-small"
                  :color="item.status === 'New' ? 'warning' : item.status === 'Contacted' ? 'info' : 'success'"
                  variant="flat"
                  class="font-weight-medium"
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

<style scoped>
.welcome-card {
  background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
  color: white;
}

.gradient-avatar {
  background: linear-gradient(135deg, #8B5CF6 0%, #6366F1 100%);
}

.section-icon {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
}

.stat-card {
  transition: transform 0.2s ease;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.stat-card:hover {
  transform: translateY(-2px);
}

.stat-icon {
  width: 40px;
  height: 40px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.9);
}

.content-card {
  background: white;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.blog-item, .team-item {
  transition: all 0.2s ease;
  background: rgba(0, 0, 0, 0.02);
}

.blog-item:hover, .team-item:hover {
  background: rgba(0, 0, 0, 0.04);
}

.gap-2 {
  gap: 8px;
}

/* Dark mode support */
:deep(.v-theme--dark) .welcome-card {
  background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
}

:deep(.v-theme--dark) .content-card {
  background: #1E1E1E;
  border-color: rgba(255, 255, 255, 0.1);
}

:deep(.v-theme--dark) .blog-item,
:deep(.v-theme--dark) .team-item {
  background: rgba(255, 255, 255, 0.05);
}

:deep(.v-theme--dark) .blog-item:hover,
:deep(.v-theme--dark) .team-item:hover {
  background: rgba(255, 255, 255, 0.08);
}

:deep(.v-theme--dark) .stat-icon {
  background: rgba(0, 0, 0, 0.2);
}

:deep(.v-theme--dark) .stat-card {
  border-color: rgba(255, 255, 255, 0.1);
}
</style>
