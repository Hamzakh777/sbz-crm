var reportsTimeframeMixin = {
    watch: {
        timeframe: function (newVal, oldVal) {
            // the route url to where we will make the request
            // defined in the component that extends this mixin
            if (this.routeUrl === undefined || this.routeUrl === null) {
                // throw "The url is required";
            }
            else {
                const timeframe = `timeframe=${newVal}`;
                const url = `${this.routeUrl}?${timeframe}`;
                
                this.fetchData(url);
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

        async fetchData(url) {
            this.isLoading = true;
            try {
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
        this.fetchData();
    }
};

export default reportsTimeframeMixin;
