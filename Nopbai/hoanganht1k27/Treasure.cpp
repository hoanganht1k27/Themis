#include<bits/stdc++.h>
using namespace std;
const int N=70;
long long p[N],mod=1000000007,L,R;
void build()
{
    p[0]=1;
    for(int i=1;i<=62;i++)
    {
        p[i]=p[i-1]*2ll;
    }
}
long long process(long long x)
{
    if(x==0) return 0;
    long long ans=0;
    int n;
    for(int i=61;i>=0;i--)
    {
        if(p[i+1]-1<=x){
            n=i;
            break;
        }
    }
    int t1=(n/2)*2;
    t1=(p[t1+2]-1)/3;
    int k1=t1;
    ans=(ans+((t1%mod)*(t1%mod))%mod)%mod;
    t1=n;
    if(n%2==0) t1--;
    t1=(p[t1+2]-2)/3;
    int k2=t1;
    ans=(ans+((t1%mod)*((t1+1)%mod))%mod)%mod;
    t1=x-p[n+1]+1;
    if(n%2==1)
    {
        ans=(ans+((((k1+t1)%mod)*((k1+t1)%mod))%mod-((k1%mod)*(k1%mod))%mod+mod)%mod)%mod;
    }
    else
       ans=(ans+((((k2+t1)%mod)*(((k2+t1)+1)%mod))-((k2%mod)*((k2+1)%mod))%mod+mod)%mod)%mod;
    return ans;
}
int main()
{
    freopen("1151C.INP","r",stdin);
    freopen("1151C.OUT","w",stdout);
    cin>>L>>R;
    build();
    cout<<(process(R)-process(L-1)+mod)%mod;
}
