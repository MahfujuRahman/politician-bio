import { defineStore } from "pinia";

export const section_heading_store = defineStore("section_heading_store", {
    state: () => ({
        all_data: [],
    }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        get_all_section_headings: async function () {
            let response = await axios.get("section-headings", {
                params: {
                    get_all: 1,
                    limit: 1000,
                },
            });
        
            this.all_data = response.data.data;
        },
        get_heading_value:function(section_type, field_name){
            console.log(section_type, field_name);
            const match = this.all_data.find(item => {
                if (item.section_type !== section_type) return false;
                // if record has explicit field_name property, prefer that match
                if (item.field_name && item.field_name === field_name) return true;
                // otherwise, check if the record contains the requested property directly
                return Object.prototype.hasOwnProperty.call(item, field_name);
            });

            console.log('matched item:', match);
            if (!match) return '';

            // prefer explicit value, otherwise return the property directly
            const field_value = (match.value !== undefined) ? match.value : match[field_name];
            console.log('field_value:', field_value);

            return field_value ?? '';
        }
        // all: async function (url) {
        //     let response;
        //     if (url) {
        //         response = await axios.get(url);
        //     } else {
        //         response = await axios.get(this.api);
        //     }
        //     this.all_data = response.data.data;
        // },

        // get: async function (id) {
        //     let response = await axios.get(this.api+id);
        //     response = response.data.data;
        //     this.single_data = response;
        // },

        // store: async function (form) {
        //     let formData = new FormData(form);
        //     let response = await axios.post(this.api, formData);
        //     return response;
        // },

        // update: async function (form, id) {
        //     let formData = new FormData(form);
        //     let response = await axios.post(`${this.api}${id}?_method=PATCH`, formData);
        //     return response;
        // },

        // delete: async function (id) {
        //     var data = await window.s_confirm();
        //     if (data) {
        //         let response = await axios.delete(this.api+id);
        //         window.s_alert("Data deleted");
        //         this.all();
        //         console.log(response.data);
        //     }
        // },
        // bulk_action: async function (action, data) {
        //     let response = await axios.post(`${this.api}bulk-action`, { action, data })
        //     if (response.data.status === "success") {
        //         window.s_alert(response.data.message);
        //         this.all();
        //     }
        // },

        // additional function
        // additional function


    },
});
