const state = {
    isLoading: false,
    compensation: {
        insuranceId: null,
        insuranceProvisoinPeriodPlanMonth: null,
        insuranceProvisoinPeriodPlanYear: null,
        salesOrderId: null,
        insuranceProvisionPeriodPlanCompleted: false,
        totalProvisionPaid: 0,

        // sales compensation
        payoutRate: 100,
    }
}

export default state;