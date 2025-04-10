/*jshint esversion: 6 */

function removeHTMLTags(htmlString) {
    // Create a new DOMParser instance
    const parser = new DOMParser();
    // Parse the HTML string
    let  doc = parser.parseFromString(htmlString, 'text/html');
    // Extract text content
    let textContent = doc.body.innerText || "";
    // Trim whitespace
    let trimmedContent = textContent.trim();

    return trimmedContent;
};

function eventValidation(eventTableName,standardTableName, eventTableFingerprint, standardTableFingerprint) {
    if ((eventTableName != '' && eventTableName === standardTableName) || (eventTableFingerprint != '' && eventTableFingerpint === standardTableFingerprint)) { 
        return true; 
    } 
    return false;
};

document.addEventListener('alpine:init', () => {


    Alpine.data('reorderFunction', () => ({
        reorderedItems: [],

        cancelReorder() {
            if (this.hideReorderColumnUnlessReorderingStatus) {
                this.reorderDisplayColumn = false;
            }
            this.$wire.disableReordering();
        },
        updateReorderedItems(items) {
            this.reorderedItems = items;
        },
        saveReorderedItems() {
            if(this.reorderedItems.length !== "undefined" && this.reorderedItems.length !== 0)
            {
                var filtered = this.reorderedItems.filter(function(value) {
                    return value != 'thead';
                });
                if (this.hideReorderColumnUnlessReorderingStatus) {
                    this.reorderDisplayColumn = false;
                }    
                this.currentlyReorderingStatus = false;

                this.$wire.storeReorder(filtered);
            }
            else
            {
                this.$wire.disableReordering();
            }
        },

    }));

    Alpine.data('laravellivewiretable', (wire) => ({
        tableId: '',
        showBulkActionsAlpine: false,
        primaryKeyName: '',
        shouldBeDisplayed: wire.entangle('shouldBeDisplayed'),
        tableName: wire.entangle('tableName'),
        dataTableFingerprint: wire.entangle('dataTableFingerprint'),
        listeners: [],
        childElementOpen: false,
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        paginationCurrentCount: wire.entangle('paginationCurrentCount'),
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount'),
        paginationCurrentItems: wire.entangle('paginationCurrentItems'),
        selectedItems: wire.entangle('selected'),
        selectAllStatus: wire.entangle('selectAll'),
        delaySelectAll: wire.entangle('delaySelectAll'),
        hideBulkActionsWhenEmpty: wire.entangle('hideBulkActionsWhenEmpty'),
        defaultReorderColumn: wire.entangle('defaultReorderColumn'),
        reorderStatus: wire.entangle('reorderStatus'),
        currentlyReorderingStatus: wire.entangle('currentlyReorderingStatus'),
        hideReorderColumnUnlessReorderingStatus: wire.entangle('hideReorderColumnUnlessReorderingStatus'),
        reorderDisplayColumn: wire.entangle('reorderDisplayColumn'),
        externalFilterPillsVals: wire.entangle('externalFilterPillsValues'),
        internalFilterPillsVals: wire.entangle('internalFilterPillsVals'),
        showFilterPillLabel: [],
        filterPillsSeparator: ', ',
        showFilterPillsSection: true,

        stripLivewireTags(data) { 
            let localHtml = data.innerHTML; 
            localHtml = localHtml.replace('<!--[if BLOCK]>', '')
                    .replace('<![endif]-->','')
                    .replace('<!--[if ENDBLOCK]>','')
                    .replace('<![endif]-->','')
                    .trim();
            return localHtml;
        },
        resetSpecificFilter(filterKey)
        {
            this.externalFilterPillsVals[filterKey] = [];
            wire.call('resetFilter',filterKey);
        },
        resetAllFilters()
        {
            this.externalFilterPillsVals = [];
            wire.call('setFilterDefaults');
        },
        setInternalFilterPillVal(filterKey, filterValues)
        {

            if(typeof(filterValues) !== 'undefined')
            {
                this.internalFilterPillsVals[filterKey] = filterValues;
            }
        },
        syncExternalFilterPillsValues(filterKey,filterValues) {
            this.externalFilterPillsVals[filterKey] = filterValues;
            this.showFilterPillLabel[filterKey] = this.getFilterPillsLength(filterKey);
        },
        getFilterPillsLength(filterKey)
        {
            return Object.keys(this.externalFilterPillsVals[filterKey]).length ?? 0;
        },
        showFilterPillsValue(filterKey, filterPillValue)
        {
            if(typeof(filterPillValue) !== "undefined")
            {
                this.externalFilterPillsVals[filterKey] = filterPillValue;
            }
            else
            {
                this.externalFilterPillsVals[filterKey] = null;
            }
            
        },
        setFilterPillsLength(externalFilterPillsValues)
        {
            let filterValueLength = 0;
            if (typeof(externalFilterPillsValues) !== 'undefined')
            {
                filterValueLength = Object.keys(externalFilterPillsValues).length ?? 0;
            }
            else
            {
                filterValueLength = 0;
            }
            return filterValueLength; 
        },
        showFilterPillsLabel(filterKey)
        {
            return (this.getFilterPillsLength(filterKey) > 0);
        },
        getFilterPillImplodedValues(filterKey, separator)
        {
            let filterPillValues = this.externalFilterPillsVals[filterKey];
            if(filterPillValues !== 'undefined')
            {
                let joinedValues = filterPillValues.join(separator);

                return joinedValues;
            }

            return '';
        },
        showFilterPillsSeparator(filterKey,index)
        {
            return ((index+1) < (this.getFilterPillsLength(filterKey)));
        },
        toggleSelectAll() {
            if (!this.showBulkActionsAlpine) {
                return;
            }

            if (this.paginationTotalItemCount === this.selectedItems.length) {
                this.clearSelected();
                this.selectAllStatus = false;
            } else {
                if (this.delaySelectAll)
                {   
                    this.setAllItemsSelected();
                }
                else
                {
                    this.setAllSelected();
                }
            }
        },
        setAllItemsSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = true;
            this.selectAllOnPage();
        },
        setAllSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            if (this.delaySelectAll)
            {   
                this.selectAllStatus = true;
                this.selectAllOnPage();
            }
            else
            {
                wire.setAllSelected();
            }
        },
        clearSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = false;
            wire.clearSelected();
        },
        selectAllOnPage() {
            if (!this.showBulkActionsAlpine) {
                return;
            }

            let tempSelectedItems = this.selectedItems;
            const iterator = this.paginationCurrentItems.values();
            for (const value of iterator) {
                tempSelectedItems.push(value.toString());
            }
            this.selectedItems = [...new Set(tempSelectedItems)];
        },
        setTableId(tableId)
        {
            this.tableId = tableId;
        },
        setAlpineBulkActions(showBulkActionsAlpine)
        {
            this.showBulkActionsAlpine = showBulkActionsAlpine;
        },
        setPrimaryKeyName(primaryKeyName)
        {
            this.primaryKeyName = primaryKeyName;
        },
        showTable(event)
        {
            
            if (eventValidation(event.detail.tableName ?? '',this.tableName, event.detail.tableFingerpint ?? '', this.dataTableFingerprint)) { 
                this.shouldBeDisplayed = true; 
            } 
        },
        hideTable(event)
        {
            if (eventValidation(event.detail.tableName ?? '',this.tableName, event.detail.tableFingerpint ?? '', this.dataTableFingerprint)) { 
                this.shouldBeDisplayed = false; 
            } 
        },
        reorderToggle() {
            wire.toggleReordering();
        },
        destroy() {
            this.listeners.forEach((listener) => {
                listener();
            });
        },
        init() {
            console.log(removeHTMLTags('<strong>Help</strong>'));
        }
    }));

    Alpine.data('booleanFilter', (wire,filterKey,tableName,defaultValue) => ({
        localListeners: [],
        switchOn: false, 
        value: wire.entangle('filterComponents.'+filterKey).live, 
        init() { 
            this.switchOn = false; 
            if (typeof this.value !== 'undefined') { 
                this.switchOn = Boolean(Number(this.value)); 
            }
            this.localListeners.push(
                Livewire.on('filter-was-set', (detail) => {
                    if(detail.tableName == this.tableName && detail.filterKey == filterKey) { 
                        this.switchOn = detail.value ?? defaultValue; 
                    }
                })
            );
        },
        destroy() {
            this.localListeners.forEach((listener) => {
                listener();
            });
        },
    }));

    Alpine.data('newBooleanFilter', (filterKey,tableName,defaultValue) => ({
        booleanFilterKey: filterKey,
        switchOn: false, 
        value: false, 
        toggleStatus()
        {
            let tempValue = Boolean(Number(this.$wire.get('filterComponents.'+this.booleanFilterKey) ?? this.value));
            let newBoolean = !tempValue;
            this.switchOn = this.value = newBoolean;
            return Number(newBoolean);
        },
        toggleStatusWithUpdate()
        {
            let newValue = this.toggleStatus();
            this.$wire.set('filterComponents.'+this.booleanFilterKey, newValue);
        },
        toggleStatusWithReset()
        {
            let newValue = this.toggleStatus();
            this.$wire.call('resetFilter',this.booleanFilterKey);
        },
        setSwitchOn(val)
        {
            let number = Number(val ?? 0);
            this.switchOn = Boolean(number); 
        },
        init() { 

            this.$nextTick(() => { 
                this.value = this.$wire.get('filterComponents.'+this.booleanFilterKey) ?? defaultValue;
                this.setSwitchOn(this.value ?? 0);
            });

            this.listeners.push(
                Livewire.on('filter-was-set', (detail) => {
                    if(detail.tableName == this.tableName && detail.filterKey == this.booleanFilterKey) { 
                        this.switchOn = detail.value ?? defaultValue; 
                    }
                })
            );
        }
    }));



    Alpine.data('numberRangeFilter', (wire, filterKey, parentElementPath, filterConfig, childElementRoot) => ({
        allFilters: wire.entangle('filterComponents', false),
        originalMin: 0,
        originalMax: 100,
        filterMin: 0,
        filterMax: 100,
        currentMin: 0,
        currentMax: 100,
        hasUpdate: false,
        wireValues: wire.entangle('filterComponents.' + filterKey, false),
        defaultMin: filterConfig['minRange'],
        defaultMax: filterConfig['maxRange'],
        restrictUpdates: false,
        initialiseStyles()
        {
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', this.wireValues['min'] ?? this.filterMin);
            numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify(this.wireValues['min'] ?? this.filterMin));
            numRangeFilterContainer.style.setProperty('--value-b', this.wireValues['max'] ?? this.filterMax);
            numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(this.wireValues['max'] ?? this.filterMax));
        },
        updateStyles(filterMin, filterMax) {
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', filterMin);
            numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify(filterMin));
            numRangeFilterContainer.style.setProperty('--value-b', filterMax);
            numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(filterMax));
        },
        setupWire() {
            if (this.wireValues !== undefined) {
                this.filterMin = this.originalMin = (this.wireValues['min'] !== undefined) ? this.wireValues['min'] : this.defaultMin;
                this.filterMax = this.originalMax = (this.wireValues['max'] !== undefined) ? this.wireValues['max'] : this.defaultMax;
            } else {
                this.filterMin = this.originalMin = this.defaultMin;
                this.filterMax = this.originalMax = this.defaultMax;
            }
            this.updateStyles(this.filterMin, this.filterMax);
        },
        allowUpdates() {
            this.updateWire();
        },
        updateWire() {
            let tmpFilterMin = parseInt(this.filterMin);
            let tmpFilterMax = parseInt(this.filterMax);
    
            if (tmpFilterMin != this.originalMin || tmpFilterMax != this.originalMax) {
                if (tmpFilterMax < tmpFilterMin) {
                    this.filterMin = tmpFilterMax;
                    this.filterMax = tmpFilterMin;
                }
                this.hasUpdate = true;
                this.originalMin = tmpFilterMin;
                this.originalMax = tmpFilterMax;
            }
            this.updateStyles(this.filterMin,this.filterMax);
        },
        updateWireable() {
            if (this.hasUpdate) {
                this.hasUpdate = false;
                this.wireValues = { 'min': this.filterMin, 'max': this.filterMax };
                wire.set('filterComponents.' + filterKey, this.wireValues);
            }
        },
        init() {
            this.initialiseStyles();
            this.setupWire();
            this.$watch('allFilters', value => this.setupWire());
        },
    }));
    
    Alpine.data('flatpickrFilter', (wire, filterKey, filterConfig, refLocation, locale) => ({
        wireValues: wire.entangle('filterComponents.' + filterKey),
        flatpickrInstance: flatpickr(refLocation, {
            mode: 'range',
            altFormat: filterConfig['altFormat'] ?? "F j, Y",
            altInput: filterConfig['altInput'] ?? false,
            allowInput: filterConfig['allowInput'] ?? false,
            allowInvalidPreload: filterConfig['allowInvalidPreload'] ?? true,
            ariaDateFormat: filterConfig['ariaDateFormat'] ?? "F j, Y",
            clickOpens: true,
            dateFormat: filterConfig['dateFormat'] ?? "Y-m-d",
            defaultDate: filterConfig['defaultDate'] ?? null,
            defaultHour: filterConfig['defaultHour'] ?? 12,
            defaultMinute: filterConfig['defaultMinute'] ?? 0,
            enableTime: filterConfig['enableTime'] ?? false,
            enableSeconds: filterConfig['enableSeconds'] ?? false,
            hourIncrement: filterConfig['hourIncrement'] ?? 1,
            locale: filterConfig['locale'] ?? 'en',
            minDate: filterConfig['earliestDate'] ?? null,
            maxDate: filterConfig['latestDate'] ?? null,
            minuteIncrement: filterConfig['minuteIncrement'] ?? 5,
            shorthandCurrentMonth: filterConfig['shorthandCurrentMonth'] ?? false,
            time_24hr: filterConfig['time_24hr'] ?? false,
            weekNumbers: filterConfig['weekNumbers'] ?? false,
            onOpen: function () {
                window.childElementOpen = true;
            },
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 1) {
                    var dates = dateStr.split(' ');
                    var wireDateArray = {};
                    window.childElementOpen = false;
                    window.filterPopoverOpen = false;
                    wireDateArray = { 'minDate': dates[0], 'maxDate': (typeof dates[2] === "undefined") ? dates[0] : dates[2] };
                    wire.set('filterComponents.' + filterKey, wireDateArray);
                }
            },
        }),
        changedValue: function(value) {
            if (value.length < 5)
            {
                this.flatpickrInstance.setDate([]);   
                wire.set('filterComponents.' + filterKey, {});
            }
        },
        setupWire() {
            if (this.wireValues !== undefined) {
                if (this.wireValues.minDate !== undefined && this.wireValues.maxDate !== undefined) {
                    let initialDateArray = [this.wireValues.minDate, this.wireValues.maxDate];
                    this.flatpickrInstance.setDate(initialDateArray);
                }
                else {
                    this.flatpickrInstance.setDate([]);
                }
            }
            else {
                this.flatpickrInstance.setDate([]);
            }
        },
        init() {
            this.setupWire();
            this.$watch('wireValues', value => this.setupWire());
        }
    
    
    }));

    Alpine.data('tableWrapper', (wire, showBulkActionsAlpine) => ({
        shouldBeDisplayed: wire.entangle('shouldBeDisplayed'),
        listeners: [],
        childElementOpen: false,
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        paginationCurrentCount: wire.entangle('paginationCurrentCount'),
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount'),
        paginationCurrentItems: wire.entangle('paginationCurrentItems'),
        selectedItems: wire.entangle('selected'),
        selectAllStatus: wire.entangle('selectAll'),
        delaySelectAll: wire.entangle('delaySelectAll'),
        hideBulkActionsWhenEmpty: wire.entangle('hideBulkActionsWhenEmpty'),
        toggleSelectAll() {
            if (!showBulkActionsAlpine) {
                return;
            }

            if (this.paginationTotalItemCount === this.selectedItems.length) {
                this.clearSelected();
                this.selectAllStatus = false;
            } else {
                if (this.delaySelectAll)
                {   
                    this.setAllItemsSelected();
                }
                else
                {
                    this.setAllSelected();
                }
            }
        },
        setAllItemsSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = true;
            this.selectAllOnPage();
        },
        setAllSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            if (this.delaySelectAll)
            {   
                this.selectAllStatus = true;
                this.selectAllOnPage();
            }
            else
            {
                wire.setAllSelected();
            }
        },
        clearSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = false;
            wire.clearSelected();
        },
        selectAllOnPage() {
            if (!showBulkActionsAlpine) {
                return;
            }

            let tempSelectedItems = this.selectedItems;
            const iterator = this.paginationCurrentItems.values();
            for (const value of iterator) {
                tempSelectedItems.push(value.toString());
            }
            this.selectedItems = [...new Set(tempSelectedItems)];
        },
        destroy() {
            this.listeners.forEach((listener) => {
                listener();
            });
        }
    }));


    Alpine.data('filterPillsHandler', (data) => ({
        localData: data,
        localFilterKey: '',
        localFilterTitle: '',
        isExternalFilter: false,
        shouldRenderAsHTML: false,
        shouldWatchPillValues: false,
        pillsSeparator: ',',
        pillValues: null,
        pillHasValues: false,
        displayString: '',
        generateLocalFilterPillImplodedValues(filterPillValues)
        {
            if(typeof(filterPillValues) !== 'undefined')
            {
                var temporarySeparatorString = '---tablepillsseparator---';
                var regex = new RegExp(temporarySeparatorString, 'g');
                var joinedValues;

                if(Array.isArray(filterPillValues))
                {
                    joinedValues = filterPillValues.join(temporarySeparatorString);
                }
                else
                {
                    joinedValues = filterPillValues;    
                }

                if(!this.shouldRenderAsHTML)
                {
                    joinedValues = removeHTMLTags(joinedValues);
                }

                if (joinedValues !== null)
                {
                    let replacedJoinedValues = joinedValues.replace(regex, this.pillsSeparator);
                    return replacedJoinedValues;
    
                }
                return "";
            }
            return "";
        },
        clearExternalFilterPill()
        {
            if(this.isExternalFilter)
            {
                this.externalFilterPillsVals[this.localFilterKey] = [];
                this.displayString = this.generateLocalFilterPillImplodedValues(this.externalFilterPillsVals[this.localFilterKey]); 
                this.updatePillHasValues();
                this.resetSpecificFilter(this.localFilterKey);
            }
        },
        trigger: {
            ['@filterpillupdate.window'](event) {
                this.watchForUpdateEvent(event);
            },
        },
        checkEventIsValid(eventTableName, eventFilterKey)
        {
            return ((this.tableName === eventTableName) && (this.localFilterKey === eventFilterKey));
        },
        watchForUpdateEvent(event)
        {
            if(this.checkEventIsValid(event.detail.tableName ?? '', event.detail.filterKey ?? ''))
            {
                let eventPillItem = event.detail.pillItem ?? '';
                if(!this.shouldRenderAsHTML)
                {
                    eventPillItem = removeHTMLTags(eventPillItem);
                }
    
                if(eventPillItem != "")
                {
                    if(this.isExternalFilter)
                    {
                        let filterPillValues = this.externalFilterPillsVals[this.localFilterKey];
    
                        filterPillValues.push(eventPillItem);
                        this.updatePillValues(filterPillValues);
                    }
                    else
                    {
                        this.updatePillValues(eventPillItem);
                    }    
                }
            }
        },
        updatePillValues(filterPillValues)
        {
            this.pillValues = filterPillValues;
            this.displayString = this.generateLocalFilterPillImplodedValues(filterPillValues); 
            this.updatePillHasValues();

            return this.displayString;
        },
        updatePillHasValues()
        {
            this.pillHasValues = (this.displayString.length > 0);
        },
        init()
        {
            this.localFilterKey = this.localData['filterKey'] ?? 'unknown';
            this.localFilterTitle = this.localData['filterPillTitle'] ?? 'Unknown';
            this.pillsSeparator = this.localData['separator'] ?? ',';
            this.shouldWatchPillValues = Boolean(this.localData['watchForEvents'] ?? 0);
            this.isExternalFilter = Boolean(this.localData['isAnExternalLivewireFilter'] ?? 0);
            this.shouldRenderAsHTML = Boolean(this.localData['renderPillsAsHtml'] ?? 0);
            this.pillValues = this.localData['pillValues'] ?? null;

            this.$nextTick(() => { 
                if(this.isExternalFilter)
                {
                    this.updatePillValues(this.externalFilterPillsVals[this.localFilterKey]);
                }
                else
                {
                    this.updatePillValues(this.pillValues);
                }
            });
            if(this.isExternalFilter && this.shouldWatchPillValues)
            {
                this.$watch('externalFilterPillsVals.'+this.localFilterKey, filterPillValues => { 
                    this.updatePillValues(filterPillValues);
                });      
            }
        }
    }));


    Alpine.data('tablesExternalFilter', (wire, filterKey) => ({
        externalFilterKey: filterKey,
        pillValues: [],
        optionsAvailable: wire.entangle('optionsAvailable'), 
        optionsSelected: wire.entangle('optionsSelected').live, 
        selectedItems: wire.entangle('selectedItems'), 
        sendValueToPill(value)
        {
            let sentValue = removeHTMLTags(value);
            this.$dispatch('filterpillupdate', { tableName: this.tableName, filterKey: this.externalFilterKey, pillItem: sentValue });
        },
        overridePill(values)
        {
            let sentValue = removeHTMLTags(values);
            this.$dispatch('filterpillupdate', { tableName: this.tableName, filterKey: this.externalFilterKey, pillItem: sentValue });
        },
        syncItems(items) { 
            this.pillValues = [];
            items.forEach((item) => {
                this.pillValues.push(this.optionsAvailable[item]);
            });
            if(this.pillValues.length > 0)
            {
                this.pillValues.sort();
                this.syncExternalFilterPillsValues(this.externalFilterKey,this.pillValues);
            }
            this.optionsSelected = this.selectedItems;
            wire.set('value', this.selectedItems);

        }, 
        init() { 
            this.selectedItems = this.optionsSelected;
            this.syncItems(this.selectedItems);
            this.$watch('selectedItems', value => this.syncItems(value)); 
        } 
    }));
});