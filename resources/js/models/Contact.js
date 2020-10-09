class Contact {
    constructor(
        {
            id = null,
            name = null,
            email = null,
            phone = null,
            created_at = null,
            updated_at = null,
            deleted_at = null,
        } = {}) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.phone = phone;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.deleted_at = deleted_at;
    }
}

export default Contact;
