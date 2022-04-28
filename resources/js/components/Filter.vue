<template>
    <FilterContainer>
        <span>{{ filter.name }}</span>

        <template #filter>
            <VueMultiselect
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
                :max-height="200"
                label="label"
                track-by="value"
                @update:model-value="handleChange"
                class="nova-multiselect-filter"
            >
                <template v-slot:noOptions>{{ noOptionsLabel }}</template>
                <template v-slot:noResult>{{ noResultLabel }}</template>
            </VueMultiselect>
        </template>
    </FilterContainer>
</template>

<script>
    import VueMultiselect from 'vue-multiselect';

    export default {
        components: {VueMultiselect},
        emits: ['change'],
        props: {
            resourceName: {
                type: String,
                required: true,
            },
            filterKey: {
                type: String,
                required: true,
            },
            lens: String,
        },

        created() {
            this.setCurrentFilterValue()
        },

        mounted: function () {
            Nova.$on('filter-reset', this.setCurrentFilterValue)
            if (this.filter.currentValue === undefined || this.filter.currentValue === '') {
                return;
            }

            this.filter.options.forEach(option => {
                if (this.filter.currentValue.indexOf(option.value) === -1) {
                    return;
                }

                this.options.push(option);
            });
        },

        beforeUnmount() {
            Nova.$off('filter-reset', this.setCurrentFilterValue)
        },

        data: function () {
            return {
                options: [],
            };
        },

        methods: {
            handleChange: function () {
                this.$store.commit(`${this.resourceName}/updateFilterState`, {
                    filterClass: this.filterKey,
                    value: this.values,
                });

                this.$emit('change');
            },
            setCurrentFilterValue() {
                this.options = this.filter.currentValue
            },
        },

        computed: {
            filter() {
                return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey);
            },

            values: function () {
                const values = [];

                this.options.forEach(option => {
                    values.push(option.value);
                });

                return values.length ? values : '';
            },

            clearOnSelect: function () {
                return this.filter.clearOnSelect !== undefined ? this.filter.clearOnSelect : true;
            },

            closeOnSelect: function () {
                return this.filter.closeOnSelect !== undefined ? this.filter.closeOnSelect : true;
            },

            deselectLabel: function () {
                return this.filter.deselectLabel || this.__('Press enter to remove');
            },

            noOptionsLabel: function () {
                return this.filter.noOptionsLabel || this.__('List is empty.');
            },

            noResultLabel: function () {
                return this.filter.noResultLabel || this.__('No elements found. Consider changing the search query.');
            },

            placeholder: function () {
                return this.filter.placeholder || this.__('Select option');
            },

            selectLabel: function () {
                return this.filter.selectLabel || this.__('Press enter to select');
            },

            selectedLabel: function () {
                return this.filter.selectedLabel || this.__('Selected');
            },

            showLabels: function () {
                return this.filter.showLabels !== undefined ? this.filter.showLabels : true;
            },
        },
    };
</script>

<style>
@import "~vue-multiselect/dist/vue-multiselect.css";

.nova-multiselect-filter .multiselect__content-wrapper {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.nova-multiselect-filter .multiselect__option--highlight::after {
    position: relative;
    display: block;
    padding: 0;
    line-height: 10px;
    font-size: 10px;
}
</style>
