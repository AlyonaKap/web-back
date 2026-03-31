export async function fetchSubscriptions(subscriberId) {
    try {
        const query = subscriberId ? '?subscriber_id=' + subscriberId : '';
        const response = await fetch('/php/api/subscriptions' + query);
        const data = await response.json();
        return data.data;
    } catch (error) {
        console.error('Error fetching subscriptions:', error);
        return [];
    }
}
