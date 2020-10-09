class Pagination {
    constructor(
        {
            total = 0,
            per_page = 10,
            current_page = 1,
            last_page = null,
            from = null,
            to = null
        } = {}) {
        this.total = total;
        this.per_page = per_page;
        this.current_page = current_page;
        this.last_page = last_page;
        this.from = from;
        this.to = to;
    }
}

export default Pagination;
