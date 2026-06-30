<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::all();

        $posts = [
            [
                'title' => 'The Future of Artificial Intelligence in Business',
                'excerpt' => 'Exploring how AI is transforming business operations and creating new opportunities for growth.',
                'content' => 'Artificial Intelligence is revolutionizing the way businesses operate. From automating routine tasks to providing deep insights through data analysis, AI is becoming an integral part of modern business strategy. In this comprehensive guide, we explore the various applications of AI in business, the benefits it offers, and the challenges organizations face when implementing AI solutions. Key areas where AI is making an impact include customer service automation, predictive analytics, supply chain optimization, and personalized marketing campaigns.',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Digital Transformation Strategies for Modern Enterprises',
                'excerpt' => 'A comprehensive guide to successfully implementing digital transformation in your organization.',
                'content' => 'Digital transformation is no longer optional for businesses looking to stay competitive. This article outlines proven strategies for implementing successful digital transformation initiatives. We cover everything from leadership buy-in to technology selection, change management, and measuring success. Learn from real-world case studies and expert insights.',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Cloud Computing Best Practices for Small Businesses',
                'excerpt' => 'Essential tips and strategies for small businesses looking to leverage cloud technology.',
                'content' => 'Cloud computing offers small businesses access to enterprise-level technology without the hefty price tag. This guide covers the essential best practices for cloud adoption. From security considerations to cost optimization and vendor selection, we provide actionable advice for small business owners.',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'Cybersecurity Trends to Watch in 2025',
                'excerpt' => 'Stay ahead of emerging cybersecurity threats and protection strategies.',
                'content' => 'As cyber threats evolve, so must our defense strategies. This article explores the latest cybersecurity trends and what organizations need to know to stay protected. We examine emerging threats, new security technologies, and best practices for building a robust cybersecurity posture.',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Building Agile Development Teams',
                'excerpt' => 'Learn how to create and manage high-performing agile development teams.',
                'content' => 'Agile development methodologies have transformed software development. This guide provides insights into building and managing successful agile teams. From team structure to communication practices and performance metrics, discover what makes agile teams successful.',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(14),
            ],
            [
                'title' => 'Data Analytics for Business Decision Making',
                'excerpt' => 'Harness the power of data analytics to make informed business decisions.',
                'content' => 'Data-driven decision making is crucial for business success. This article explores how to leverage data analytics for better business outcomes. Learn about different types of analytics, tools and technologies, and how to build a data-driven culture in your organization.',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(16),
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'title' => $postData['title'],
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'status' => $postData['status'],
                'is_featured' => $postData['is_featured'],
                'published_at' => $postData['published_at'],
            ]);

            // Attach random tags to each post
            $randomTags = $tags->random(rand(2, 5));
            $post->tags()->attach($randomTags->pluck('id')->toArray());
        }
    }
}
