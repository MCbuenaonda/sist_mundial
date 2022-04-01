import { db } from "../firebase";
const _db = db.ref('/config');

class DataService {
    getAll() {
        return _db;
    }

    create(obj) {
        return _db.push(obj);
    }

    update(key, value) {
        return _db.child(key).update(value);
    }

    delete(key) {
        return _db.child(key).remove();
    }
}

export default new DataService();