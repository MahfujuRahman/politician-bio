import axios from "axios";
import setup from "../../setup";
import { mapWritableState } from "pinia";
import { store } from "..";

async function execute(event_id: string | number) {
    let state = mapWritableState(store, [
        'item',
    ]);
    let url = `${setup.api_host}/${setup.api_version}/${setup.api_end_point}`;
    try {
        let response = await axios.get(url,{ params: { event_id } });
        if (response.data.data) {
            state.item.set(response.data.data);
            return response.data.data;
        } else {
            // If no data found for this event_id, return null
            state.item.set({});
            return null;
        }
    } catch (error: any) {
        // If 404 or no data, just return null without showing error
        if (error.response?.status === 404) {
            state.item.set({});
            return null;
        }
        (window as any).s_alert('Error fetching event facility data.', 'error');
        return null;
    }
}

export default execute;
