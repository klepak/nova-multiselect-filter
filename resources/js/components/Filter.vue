<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

        <div class="p-2">
            <multiselect
                v-model="options"
                :options="this.filter.options"
                :clear-on-select="clearOnSelect"
                :close-on-select="closeOnSelect"
                :deselect-label="deselectLabel"
                :multiple="true"
                :placeholder="placeholder"
                :select-label="selectLabel"
                :selected-label="selectedLabel"
                :show-labels="showLabels"
                label="name"
                track-by="value"
                @update:modelValue="handleChange"
            >
                <template v-slot:noOptions>{{ noOptionsLabel }}</template>
                <template v-slot:noResult>{{ noResultLabel }}</template>
            </multiselect>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        components: {Multiselect},
        props: {
            resourceName: {
                type: String,
                required: true,
            },
            filterKey: {
                type: String,
                required: true,
            },
        },

        mounted() {
            let currentValue = this.filter.currentValue;

            if (typeof currentValue === 'string' && currentValue !== '') {
                try {
                    currentValue = JSON.parse(currentValue);
                } catch (error) {
                    currentValue = [];
                }
            }

            const values = Array.isArray(currentValue) ? currentValue : [];

            this.options = this.filter.options.filter(option => values.includes(option.value));
        },

        data: function () {
            return {
                options: [],
            };
        },

        methods: {
            handleChange() {
                this.$store.commit(`${this.resourceName}/updateFilterState`, {
                    filterClass: this.filterKey,
                    value: this.values,
                });

                this.$emit('change');
            },
        },

        computed: {
            filter() {
                return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey);
            },

            values() {
                const values = this.options.map(option => option.value);

                return values.length ? values : '';
            },

            clearOnSelect() {
                return this.filter.clearOnSelect !== undefined ? this.filter.clearOnSelect : true;
            },

            closeOnSelect() {
                return this.filter.closeOnSelect !== undefined ? this.filter.closeOnSelect : true;
            },

            deselectLabel() {
                return this.filter.deselectLabel || this.__('Press enter to remove');
            },

            noOptionsLabel() {
                return this.filter.noOptionsLabel || this.__('List is empty.');
            },

            noResultLabel() {
                return this.filter.noResultLabel || this.__('No elements found. Consider changing the search query.');
            },

            placeholder() {
                return this.filter.placeholder || this.__('Select option');
            },

            selectLabel() {
                return this.filter.selectLabel || this.__('Press enter to select');
            },

            selectedLabel() {
                return this.filter.selectedLabel || this.__('Selected');
            },

            showLabels() {
                return this.filter.showLabels !== undefined ? this.filter.showLabels : true;
            },
        },
    };
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
