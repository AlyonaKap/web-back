<template>
    <div>
        <h1>Subscribers & Subscriptions</h1>
        <!-- Subscriber Filter -->
        <div class="filter-container">
            <label for="subscriber-select" class="filter-label">Filter by Subscriber:</label>
            <select
                    id="subscriber-select"
                    v-model="selectedSubscriber"
                    @change="filterSubscriptions"
                    class="filter-select"
            >
                <option value="">All Subscribers</option>
                <option v-for="subscriber in subscribers" :key="subscriber.id" :value="subscriber.id">
                    {{ subscriber.name }} ({{ subscriber.email }})
                </option>
            </select>
        </div>

        <!-- Subscription List -->
        <div class="product-container" v-if="filteredSubscriptions.length">
            <div v-for="subscription in filteredSubscriptions" :key="subscription.id" class="product-card">
                <div class="product-info">
                    <h3 class="product-title">{{ subscription.service }}</h3>
                    <p class="product-description">Topic: {{ subscription.topic }}</p>
                    <div class="product-footer">
                        <span class="product-price">Expires: {{ subscription.expired_at ? subscription.expired_at.substring(0, 10) : 'N/A' }}</span>
                        <span class="badge">ID: {{ subscription.id }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="loading">No subscriptions found</div>
    </div>
</template>

<script>
import {fetchSubscriptions} from '@/services/products.service.js';
import {fetchSubscribers} from '@/services/categories.service.js';

export default {
    data() {
        return {
            subscriptions: [],
            selectedSubscriber: '',
            filteredSubscriptions: [],
            subscribers: [],
        };
    },
    async created() {
        this.subscribers = await fetchSubscribers();
        this.subscriptions = await fetchSubscriptions();
        this.filteredSubscriptions = this.subscriptions;
    },
    methods: {
        async filterSubscriptions() {
            if (this.selectedSubscriber) {
                this.filteredSubscriptions = this.subscriptions.filter(
                    s => s.subscriber_id == this.selectedSubscriber
                );
            } else {
                this.filteredSubscriptions = this.subscriptions;
            }
        }
    }
};
</script>

<style scoped>
.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.product-card {
    background-color: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.product-info {
    padding: 15px;
}

.product-title {
    font-size: 1.2em;
    font-weight: bold;
    color:#181717;
}

.product-description {
    font-size: 1em;
    color: #666;
}

.product-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
}

.product-price {
    font-size: 0.9em;
    color: #333;
}

.badge {
    padding: 4px 8px;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    font-size: 0.85em;
}

.loading {
    font-size: 1.5em;
    color: #007bff;
    text-align: center;
    margin-top: 20px;
}

.filter-container {
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.filter-label {
    font-size: 1.1em;
    margin-right: 10px;
}

.filter-select {
    padding: 8px;
    font-size: 1em;
    border-radius: 4px;
    border: 1px solid #ddd;
}
</style>
