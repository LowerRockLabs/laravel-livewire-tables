/*jshint esversion: 6 */
import newBooleanFilter from "./partials/filter-boolean.min.js";
import nrf from "./partials/filter-number-range.min.js";
import table from "./partials/table.min.js";
import tableWrapper from "./partials/tableWrapper.min.js";
import tableReorder from "./partials/reorder.min.js";
import fpf  from "./partials/filter-date-range.min.js";

document.addEventListener('alpine:init', () => {
    tableWrapper();
    table();
    tableReorder();
    newBooleanFilter();
    nrf();
    fpf();
});