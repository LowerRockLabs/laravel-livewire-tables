/*jshint esversion: 6 */

function newBooleanFilter() {
    Alpine.data('newBooleanFilter', (filterKey,tableName,defaultValue) => ({
        switchOn: false, 
        value: false, 
        toggleStatus()
        {
            let tempValue = Boolean(Number(this.$wire.get('filterComponents.'+filterKey) ?? this.value));
            let newBoolean = !tempValue;
            this.switchOn = this.value = newBoolean;
            return Number(newBoolean);
        },
        toggleStatusWithUpdate()
        {
            let newValue = this.toggleStatus();
            this.$wire.set('filterComponents.'+filterKey, newValue);
        },
        toggleStatusWithReset()
        {
            let newValue = this.toggleStatus();
            this.$wire.call('resetFilter',filterKey);
        },
        setSwitchOn(val)
        {
            let number = Number(val ?? 0);
            this.switchOn = Boolean(number); 
        },
        init() { 
            this.$nextTick(() => { 
                this.value = this.$wire.get('filterComponents.'+filterKey) ?? defaultValue;
                this.setSwitchOn(this.value ?? 0);
            });

            this.listeners.push(
                Livewire.on('filter-was-set', (detail) => {
                    if(detail.tableName == tableName && detail.filterKey == filterKey) { 
                        this.switchOn = detail.value ?? defaultValue; 
                    }
                })
            );
        }
    }));
}

export default newBooleanFilter;