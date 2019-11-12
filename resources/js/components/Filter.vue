<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

        <div class="p-2">
            <multiselect
                v-model="selectValue"
                :options="this.filter.options"
                :close-on-select="false"
                :clear-on-select="false"
                :multiple="true"
                :placeholder="__('Select option')"
                :selectLabel="__('Press enter to select')"
                :selectedLabel="__('Selected')"
                :deselectLabel="__('Press enter to remove')"
                label="name"
                track-by="value"
                @input="handleChange"
            >

                <span
                    slot="noResult"
                >{{ __('Oops! No elements found. Consider changing the search query.')}}</span>

                <span slot="noOptions">{{ __('List is empty')}}</span>
            </multiselect>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    components: { Multiselect },
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
        if(this.filter.currentValue != undefined && this.filter.currentValue != "")
        {
            this.filter.currentValue.forEach(currentValueElem => {
                this.filter.options.forEach(element => {
                    if(element.value == currentValueElem)
                        this.selectValue.push(element)
                })
            })
        }
    },

    data() {
        return {
            selectValue: [],
        };
    },

    methods: {
        handleChange(value) {
            this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value: this.values,
            })

            this.$emit('change')
        },
    },

    computed: {
        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey)
        },

        values() {
            let values = []

            this.selectValue.forEach(element => {
                values.push(element.value)
            });

            return values
        },
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
