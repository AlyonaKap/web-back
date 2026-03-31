export async function fetchSubscribers() {
    try {
        const response = await fetch('/php/api/subscribers');
        const data = await response.json();
        return data.data;
    } catch (error) {
        console.error('Error fetching subscribers:', error);
        return [];
    }
}
