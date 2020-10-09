import Axios from 'axios';
import Request from './RequestConfig';

const RESOURCE_NAME = Request;

export default {
    create(data) {
        return Axios.post(RESOURCE_NAME + '/contact', data);
    },
    remove(data) {
        return Axios.delete(RESOURCE_NAME + '/contact', {data: data});
    },
    list(data) {
        return Axios.get(RESOURCE_NAME + '/contacts', {params: data});
    },
    getbyid(data){
        return Axios.get(RESOURCE_NAME + '/contact/' + data.id);
    },
    update(data) {
        return Axios.put(RESOURCE_NAME + '/contact', data);
    },
};
