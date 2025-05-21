<script setup lang="ts">
import FrontEndLayout from '@/layouts/FrontEndLayput.vue';
import PageHero from '@/components/PageHero.vue';
import FooterSection from '@/components/FooterSection.vue';

const blogPosts = [
  {
    id: 1,
    title: 'Understanding GST Compliance for Small Businesses',
    excerpt: 'A comprehensive guide to GST compliance requirements and best practices for small businesses in India.',
    category: 'Taxation',
    author: 'Rajesh Kumar',
    date: 'March 15, 2024',
    readTime: '8 min read',
    image: 'https://picsum.photos/seed/gst/800/600',
    tags: ['GST', 'Compliance', 'Small Business']
  },
  {
    id: 2,
    title: 'Tax Planning Strategies for FY 2024-25',
    excerpt: 'Essential tax planning strategies to optimize your tax liability in the upcoming financial year.',
    category: 'Tax Planning',
    author: 'Priya Sharma',
    date: 'March 12, 2024',
    readTime: '10 min read',
    image: 'https://picsum.photos/seed/tax/800/600',
    tags: ['Tax Planning', 'Financial Year', 'Strategy']
  },
  {
    id: 3,
    title: 'Digital Transformation in Accounting',
    excerpt: 'How technology is revolutionizing the accounting industry and what it means for your business.',
    category: 'Technology',
    author: 'Amit Patel',
    date: 'March 10, 2024',
    readTime: '6 min read',
    image: 'https://picsum.photos/seed/digital/800/600',
    tags: ['Digital', 'Technology', 'Accounting']
  },
  {
    id: 4,
    title: 'Startup Funding: A Complete Guide',
    excerpt: 'Everything you need to know about funding options and financial planning for startups.',
    category: 'Startup',
    author: 'Neha Gupta',
    date: 'March 8, 2024',
    readTime: '12 min read',
    image: 'https://picsum.photos/seed/startup/800/600',
    tags: ['Startup', 'Funding', 'Finance']
  },
  {
    id: 5,
    title: 'Audit Best Practices for 2024',
    excerpt: 'Key audit practices and compliance requirements for businesses in 2024.',
    category: 'Audit',
    author: 'Vikram Singh',
    date: 'March 5, 2024',
    readTime: '9 min read',
    image: 'https://picsum.photos/seed/audit/800/600',
    tags: ['Audit', 'Compliance', 'Best Practices']
  },
  {
    id: 6,
    title: 'Financial Planning for Business Growth',
    excerpt: 'Strategic financial planning approaches to drive sustainable business growth.',
    category: 'Finance',
    author: 'Sneha Reddy',
    date: 'March 3, 2024',
    readTime: '7 min read',
    image: 'https://picsum.photos/seed/finance/800/600',
    tags: ['Finance', 'Growth', 'Strategy']
  }
];

const categories = [
  { name: 'Taxation', count: 12 },
  { name: 'Tax Planning', count: 8 },
  { name: 'Technology', count: 6 },
  { name: 'Startup', count: 10 },
  { name: 'Audit', count: 7 },
  { name: 'Finance', count: 9 }
];

const popularTags = [
  'GST', 'Compliance', 'Tax Planning', 'Startup', 'Finance',
  'Technology', 'Audit', 'Strategy', 'Digital', 'Business'
];
</script>

<template>
  <FrontEndLayout>
    <PageHero
      title="Our Blog"
      subtitle="Insights, updates, and expert analysis from our team"
      badge="Latest Articles"
      background-image="https://picsum.photos/seed/blog/1920/1080"
    />

    <!-- Main Content Section -->
    <section class="blog-content-section">
    <v-container>
        <v-row>
          <!-- Blog Posts -->
          <v-col cols="12" lg="8">
            <div class="blog-posts">
              <div v-for="post in blogPosts" :key="post.id" class="blog-card">
                <div class="blog-image-wrapper">
                  <img :src="post.image" :alt="post.title" class="blog-image">
                  <div class="blog-category">{{ post.category }}</div>
                </div>
                <div class="blog-content">
                  <div class="blog-meta">
                    <span class="blog-author">
                      <v-icon icon="mdi-account" size="16"></v-icon>
                      {{ post.author }}
                    </span>
                    <span class="blog-date">
                      <v-icon icon="mdi-calendar" size="16"></v-icon>
                      {{ post.date }}
                    </span>
                    <span class="blog-read-time">
                      <v-icon icon="mdi-clock-outline" size="16"></v-icon>
                      {{ post.readTime }}
                    </span>
                  </div>
                  <h2 class="blog-title">{{ post.title }}</h2>
                  <p class="blog-excerpt">{{ post.excerpt }}</p>
                  <div class="blog-tags">
                    <v-chip
                      v-for="tag in post.tags"
                      :key="tag"
                      size="small"
                      class="blog-tag"
                    >
                      {{ tag }}
                    </v-chip>
                  </div>
                  <v-btn
                    variant="text"
                    color="primary"
                    class="read-more-btn"
                  >
                    Read More
                    <v-icon icon="mdi-arrow-right" class="ml-2"></v-icon>
                  </v-btn>
                </div>
              </div>
            </div>
          </v-col>

          <!-- Sidebar -->
          <v-col cols="12" lg="4">
            <div class="blog-sidebar">
              <!-- Search -->
              <div class="sidebar-widget search-widget">
                <v-text-field
                  placeholder="Search articles..."
                  prepend-inner-icon="mdi-magnify"
                  variant="outlined"
                  density="comfortable"
                  hide-details
                ></v-text-field>
              </div>

              <!-- Categories -->
              <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <div class="category-list">
                  <div v-for="category in categories" :key="category.name" class="category-item">
                    <span class="category-name">{{ category.name }}</span>
                    <span class="category-count">{{ category.count }}</span>
                  </div>
                </div>
              </div>

              <!-- Popular Tags -->
              <div class="sidebar-widget">
                <h3 class="widget-title">Popular Tags</h3>
                <div class="tags-cloud">
                  <v-chip
                    v-for="tag in popularTags"
                    :key="tag"
                    size="small"
                    class="tag-chip"
                  >
                    {{ tag }}
                  </v-chip>
                </div>
              </div>

              <!-- Newsletter -->
              <div class="sidebar-widget newsletter-widget">
                <h3 class="widget-title">Subscribe to Newsletter</h3>
                <p class="newsletter-text">Get the latest articles and insights delivered to your inbox.</p>
                <v-text-field
                  placeholder="Enter your email"
                  variant="outlined"
                  density="comfortable"
                  hide-details
                  class="mb-3"
                ></v-text-field>
                <v-btn
                  color="primary"
                  block
                  class="subscribe-btn"
                >
                  Subscribe
                </v-btn>
              </div>
            </div>
          </v-col>
        </v-row>
    </v-container>
    </section>

    <FooterSection />
  </FrontEndLayout>
</template>

<style>
/* Hero Section */
.blog-hero {
  position: relative;
  height: 50vh;
  min-height: 400px;
  background: url('https://picsum.photos/seed/blog-hero/1920/1080') center/cover no-repeat;
  display: flex;
  align-items: center;
  color: white;
}

.blog-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
}

.blog-hero-content {
  position: relative;
  z-index: 1;
  max-width: 800px;
}

.blog-hero-title {
  font-size: 56px;
  font-weight: 800;
  margin-bottom: 24px;
  line-height: 1.2;
}

.blog-hero-subtitle {
  font-size: 20px;
  opacity: 0.9;
  max-width: 600px;
}

/* Blog Content Section */
.blog-content-section {
  padding: 96px 0;
  background: var(--background-light);
}

/* Blog Card */
.blog-card {
  background: white;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  margin-bottom: 32px;
  transition: transform 0.3s ease;
}

.blog-card:hover {
  transform: translateY(-5px);
}

.blog-image-wrapper {
  position: relative;
  height: 240px;
  overflow: hidden;
}

.blog-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.blog-card:hover .blog-image {
  transform: scale(1.05);
}

.blog-category {
  position: absolute;
  top: 16px;
  left: 16px;
  background: var(--primary-color);
  color: white;
  padding: 6px 12px;
  border-radius: 16px;
  font-size: 14px;
  font-weight: 600;
}

.blog-content {
  padding: 32px;
}

.blog-meta {
  display: flex;
  gap: 24px;
  margin-bottom: 16px;
  color: var(--text-secondary);
  font-size: 14px;
}

.blog-meta span {
  display: flex;
  align-items: center;
  gap: 6px;
}

.blog-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 16px;
  color: var(--text-primary);
  line-height: 1.4;
}

.blog-excerpt {
  font-size: 16px;
  color: var(--text-secondary);
  margin-bottom: 24px;
  line-height: 1.6;
}

.blog-tags {
  display: flex;
  gap: 8px;
  margin-bottom: 24px;
  flex-wrap: wrap;
}

.blog-tag {
  background: rgba(37,99,235,0.1);
  color: var(--primary-color);
}

.read-more-btn {
  padding: 0;
  font-weight: 600;
}

/* Sidebar */
.blog-sidebar {
  position: sticky;
  top: 32px;
}

.sidebar-widget {
  background: white;
  border-radius: 24px;
  padding: 32px;
  margin-bottom: 32px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.widget-title {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 24px;
  color: var(--text-primary);
}

/* Categories */
.category-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.category-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 16px;
  border-bottom: 1px solid rgba(0,0,0,0.1);
}

.category-item:last-child {
  border-bottom: none;
  padding-bottom: 0;
}

.category-name {
  color: var(--text-primary);
  font-weight: 500;
}

.category-count {
  background: rgba(37,99,235,0.1);
  color: var(--primary-color);
  padding: 4px 12px;
  border-radius: 16px;
  font-size: 14px;
  font-weight: 600;
}

/* Tags */
.tags-cloud {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.tag-chip {
  background: rgba(37,99,235,0.1);
  color: var(--primary-color);
}

/* Newsletter */
.newsletter-text {
  color: var(--text-secondary);
  margin-bottom: 24px;
  line-height: 1.6;
}

.subscribe-btn {
  height: 48px;
}

/* Responsive Design */
@media (max-width: 960px) {
  .blog-hero-title {
    font-size: 40px;
  }

  .blog-hero-subtitle {
    font-size: 18px;
  }

  .blog-sidebar {
    position: static;
    margin-top: 48px;
  }
}

@media (max-width: 600px) {
  .blog-hero {
    height: 40vh;
  }

  .blog-hero-title {
    font-size: 32px;
  }

  .blog-image-wrapper {
    height: 200px;
  }

  .blog-content {
    padding: 24px;
  }

  .blog-meta {
    flex-direction: column;
    gap: 12px;
  }
}
</style>
