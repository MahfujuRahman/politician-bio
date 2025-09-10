import axios from "axios";
import setup from "../../setup";
import { mapState } from "pinia";
import { store } from "..";

async function execute( params: any = {} ) {
    let state = mapState(store,['item']);

    // Use the slug from params if provided, otherwise from state
    const slug = params.slug || state.item().slug;
    let url = `${setup.api_host}/${setup.api_version}/${setup.api_end_point}/update/${slug}`;
    
    // Use the is_voting value from params if provided, otherwise toggle the current state
    const isVoting = params.hasOwnProperty('is_voting') ? params.is_voting : (state.item().is_voting === 1 ? 0 : 1);

    try {
        let response = await axios.post(url, {
            is_voting: isVoting
        });

        return response;
    } catch (error: any) {
        return error.response;
    }
}

export default execute;
