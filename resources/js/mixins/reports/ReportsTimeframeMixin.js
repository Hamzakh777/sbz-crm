var reportsTimeframeMixin = {
    watch: {
        timeframe: function (newVal, oldVal) {
            // the route url to where we will make the request
            // defined in the component that extends this mixin
            if (typeof newVal !== undefined) {
                const timeframe = `timeframe=${newVal}`;    
                this.fetchData(timeframe);
            }
        }
    },

    data() {
        return {
            timeframe: null,
            responseData: null,
            isLoading: false
        };
    },

    methods: {
        setTimeframe(value) {
            this.timeframe = value;
        },

        async fetchData(timeframe) {
            if (this.routeUrl === undefined || this.routeUrl === null) {
                throw "The url is required";
            }
            this.isLoading = true;
            try {
                const url = `${this.routeUrl}?${timeframe}`
                const response = await axios.get(url);

                this.responseData = response.data;
                this.isLoading = false;
            } catch (error) {
                this.isLoading = false;
                console.error(error);
            }
        }   
    },

    mounted() {
        const timeframe = `timeframe=${this.timeframe}`;    
        this.fetchData(timeframe);
    }
};

export default reportsTimeframeMixin;
