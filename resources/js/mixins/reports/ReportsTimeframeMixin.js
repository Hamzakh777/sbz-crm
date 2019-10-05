var reportsTimeframeMixin = {
    data() {
        return {
            timeframe: null
        };
    },
    methods: {
        setTimeframe(value) {
            this.timeframe = value;
        }
    },
};

export default reportsTimeframeMixin;
