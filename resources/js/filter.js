import Filter from './components/Filter.vue';

Nova.booting((app) => {
    app.component('nova-multiselect-filter', Filter);
});
