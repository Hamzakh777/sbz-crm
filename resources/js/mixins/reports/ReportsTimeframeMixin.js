var reportsTimeframeMixin = {
    watch: {
        timeframe: function (newVal, oldVal) {
            console.log('oldVal', oldVal);
            console.log('newVal', newVal);
        }
    },
    data() {
        return {
            timeframe: null,
            response: null,
        };
    },
    methods: {
        setTimeframe(value) {
            this.timeframe = value;
        },

        async fetchData(url) {
            
        }   
    },
};

export default reportsTimeframeMixin;
