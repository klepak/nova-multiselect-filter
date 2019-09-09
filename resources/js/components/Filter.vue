<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

        <div class="p-2">
            <multiselect
                v-model="options"
                :options="this.filter.options"
                :close-on-select="false"
                :clear-on-select="false"
                :multiple="true"
                :placeholder="placeholder"
                :show-labels="showLabels"
                :select-label="selectLabel"
                :selected-label="selectedLabel"
                :deselect-label="deselectLabel"
                label="name"
                track-by="value"
                @input="handleChange"
            >
                <template v-slot:noOptions>{{ noOptionsLabel }}</template>
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

        mounted: function () {
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
        },

        computed: {
            filter: function () {
                return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey);
            },

            values: function () {
                const values = [];

                this.options.forEach(option => {
                    values.push(option.value);
                });

                return values.length ? values : '';
            },

            placeholder: function () {
                return this.filter.placeholder || this.__('Select option');
            },

            showLabels: function () {
                return this.filter.showLabels !== undefined ? this.filter.showLabels : true;
            },

            selectLabel: function () {
                return this.filter.selectLabel || this.__('Press enter to select');
            },

            selectedLabel: function () {
                return this.filter.selectedLabel || this.__('Selected');
            },

            deselectLabel: function () {
                return this.filter.deselectLabel || this.__('Press enter to remove');
            },

            noOptionsLabel: function () {
                return this.filter.noOptionsLabel || this.__('List is empty.');
            },
        },
    };
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
